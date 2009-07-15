#!/bin/sh

# This script is located on the server and is run from either the server's cron
# or the webserver (i.e. PHP).  It performs a full dump of the database and 
# stores that in an encrypted + signed + compressed format.  It also clears out
# any backups that are older than a year.

# Customisable options #########################################################

# Where do you want everything done?  ROOTDIR/{tmp,data,incoming} should already
# exist and be writable
ROOTDIR=/path/to/backup

# Make sure important things are in our path
PATH=/bin:/usr/bin

# Where is the equivalent of ~/.gnupg?
GPGHOME=/path/to/.gnupg

# What is the keyID that we want to encrypt and sign to?
KEYID=0x12345678

# PostgreSQL user with SELECT privileges
PGUSER=backup

# Business time ################################################################

# Set the timestamp so that it is consistent across the script
TIMESTAMP=`date +'%Y-%m-%dT%H%M%S%Z'`

# Create a directory in ROOTDIR/tmp to work in (in case multiple instances of
# this script are running)
TMP=${ROOTDIR}/tmp/${RANDOM}
mkdir -p ${TMP}

# Dump the database
pg_dump --file=${TMP}/dump.sql \
        --blobs \
        --oids \
        --no-owner \
        --no-privileges \
        --user=${PGUSER} \
        uamuzibora

# Create a file containing the timestamp
echo ${TIMESTAMP} > ${TMP}/TIMESTAMP

# Move everything into a timestamped directory, ready for processing
mkdir ${TMP}/${TIMESTAMP}
mv ${TMP}/dump.sql ${TMP}/${TIMESTAMP}
mv ${TMP}/TIMESTAMP ${TMP}/${TIMESTAMP}

# Compress
cd ${TMP}
tar cjf ${TIMESTAMP}.tar.bz2 ${TIMESTAMP}

# Encrypt and sign
gpg --homedir ${GPGHOME} \
    --no-verbose \
    --quiet \
    --output ${TMP}/${TIMESTAMP}.tar.bz2.gpg \
    --encrypt \
    --recipient ${KEYID} \
    --sign \
    --local-user ${KEYID} \
    --always-trust \
    ${TMP}/${TIMESTAMP}.tar.bz2

# Move to data directory
mv ${TMP}/${TIMESTAMP}.tar.bz2.gpg ${ROOTDIR}/data

# Remove temporary files
rm -Rf ${TMP}

# Remove any backups older than one year
find ${ROOTDIR}/data/*.tar.bz2.gpg -mtime +365 -exec rm {} \;

exit 0
