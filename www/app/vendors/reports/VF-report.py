#!/usr/local/bin/python


from report_templates import *
print start,end
monthsArray=['Jan','Feb','March','April','May','June','Juli','Aug','Sept','Okt','Nov','Des']
#Connect to the database

# get data
vfNumber=len(db.query('SELECT pid FROM medical_informations WHERE patient_source_id=6 AND '+transDate).getresult())

#allPeriod=db.query('SELECT * FROM medical_informations WHERE 'transDate).getresult()
all=db.query('SELECT * FROM medical_informations').getresult()
allPeriod=db.query('SELECT * FROM medical_informations WHERE '+transDate).getresult()
allLen=len(allPeriod)
otherNumber=allLen-vfNumber
Vct=len(db.query('SELECT pid FROM medical_informations WHERE patient_source_id=3 AND '+transDate).getresult())
inPatient=len(db.query('SELECT pid FROM medical_informations WHERE patient_source_id=2 AND '+transDate).getresult())
OtherMoreGroups=allLen-vfNumber-Vct-inPatient

    

vfArv=len(db.query('SELECT pid FROM medical_informations WHERE patient_source_id=6 AND art_indication_id!=0 AND '+transDate).getresult())
allArv=len(db.query('SELECT pid FROM medical_informations WHERE art_indication_id!=0 AND '+transDate).getresult())
otherArv=allArv-vfArv
vfWho=[]
otherWho=[]
for i in range(1,5):
    Vf=len(db.query('SELECT pid FROM medical_informations WHERE patient_source_id=6 AND hiv_positive_who_stage = '+str(i)+' AND ' +transDate).getresult())
    a=len(db.query('SELECT pid FROM medical_informations WHERE hiv_positive_who_stage ='+str(i)+' AND '+transDate).getresult())
    other=a-Vf
    vfWho.append(Vf)
    otherWho.append(other)

vfWho=numpy.array(vfWho)
otherWho=numpy.array(otherWho)
missingVf=vfNumber-numpy.sum(vfWho)
missingOther=otherNumber-numpy.sum(otherWho)
missing=[missingVf,missingOther]


yearsVf={}
yearsOther={}
monthsVf={}
monthsOther={}
for i in all:
    if i[1]==6:
        
        if i[10]:
            year= i[10][0:4]
            if year in yearsVf:
                yearsVf[year]+=1
            else:
                yearsVf[year]=1
            if not year in yearsOther:
                yearsOther[year]=0
            month=i[10][0:7]
            if month in monthsVf:
                monthsVf[month]+=1
            else:
                monthsVf[month]=1
            if not month in monthsOther:
                monthsOther[month]=0
    else:
        if i[10]:
            year= i[10][0:4]
            if year in yearsOther:
                yearsOther[year]+=1
            else:
                yearsOther[year]=1
            if not year in yearsVf:
                    yearsVf[year]=0
            month=i[10][0:7]
            if month in monthsVf:
                monthsOther[month]+=1
            else:
                monthsOther[month]=1
            if not month in monthsVf:
                monthsVf[month]=0


#CD4
vfCd4=[]
otherCd4=[]
for i in all:
    if i[1]==6:
        res=db.query('SELECT id FROM results WHERE pid='+str(i[0])+' AND test_id=19 ORDER BY test_performed Asc').getresult()
        if res:
            if res[0][0]:
                count=db.query('SELECT value_decimal FROM result_values WHERE result_id='+str(res[0][0])).getresult()
                
                if count[0][0]:
                
                    vfCd4.append(count[0][0])
    else:
        res=db.query('Select id FROM results WHERE pid='+str(i[0])+' AND test_id=19 ORDER BY test_performed asc').getresult()
        if res:
            if res[0][0]:

                count=db.query('SELECT value_decimal FROM result_values WHERE result_id='+str(res[0][0])).getresult()
                
                if count[0][0]:
                    otherCd4.append(count[0][0])
                
            
vfCd4=numpy.array(vfCd4)
otherCd4=numpy.array(otherCd4)

if len(vfCd4)>0 and len(otherCd4)>0:
	meanVf,meanOther,p_value= numpy.mean(vfCd4),numpy.mean(otherCd4),stats.ttest_ind(vfCd4,otherCd4)[1]
else:
	meanVf,meanOther,p_value=0,0,0	
# generate plots:
width=0.5



otherWhoPlot=otherWho+vfWho

x=numpy.arange(4)+1




p2=pylab.bar(x,otherWhoPlot,width, color='green',align='center')

p1=pylab.bar(x,vfWho,width,color='orange',align='center')
pylab.xticks(x, ('1', '2', '3', '4' ))




           
pylab.legend( (p1[0], p2[0]), ('VF', 'other') )


#Decorating the plot
decoratePlot()

pylab.savefig('who.png')

# Patient source
pylab.figure(figsize=(9,9))
data=numpy.array([vfNumber,Vct,inPatient, OtherMoreGroups])
pylab.pie(data,colors=('orange','green','blue','gray'))
percent=data/float(allLen) *100

pylab.legend(['VF %3.1f %%'% percent[0] ,'VCT %3.1f %%'%percent[1],'Inpatient %3.1f %%'%percent[2],'Other %3.1f %%'%percent[3]])
#Decorating the plot
decoratePlot()
pylab.savefig('src.png')
# Figure about admission per year
pylab.figure()

x=numpy.arange(len(yearsVf))

years=yearsVf.keys()
years.sort()
vfYears=[]
otherYears=[]
for year in years:
    vfYears.append(yearsVf[year])
    otherYears.append(yearsOther[year])
vfYears=numpy.array(vfYears)
otherYears=numpy.array(otherYears)+vfYears
if len(yearsVf)==0:
	x=numpy.arange(1)
	otherYears=[0]
	vfYears=[0]
p2=pylab.bar(x,otherYears,width, color='green',align='center')
p1=pylab.bar(x,vfYears,width,color='orange',align='center')
pylab.xticks(x, years)

pylab.legend( (p1[0], p2[0]), ('VF', 'other') )

#Decorating the plot
decoratePlot()
pylab.savefig('year.png')

#Month

pylab.figure()
numb_months=8 # Number of months displayed
months=monthsVf.keys()
months.sort()
monthsPretty=[]
#Start day, month and year

lastMonth=0;
for month in months:
    year,m=month.split('-')
    if m<=startMonth and year<=startYear:
        lastMonth+=1
    monthsPretty.append(monthsArray[int(m)-1]+' '+year)
#Find last month to display. It should be the month of the start point for the period

vfMonths=[]
otherMonths=[]
for m in months:
    vfMonths.append(monthsVf[m])
    otherMonths.append(monthsOther[m])
    
vfMonths=numpy.array(vfMonths)
if len(monthsVf)==0:
	x=numpy.arange(1)
	otherMonths=[0]
	vfMonths=[0]
	numb_months=1
	monthsPretty=['No data']

otherMonths=numpy.array(otherMonths)+vfMonths

x=numpy.arange(numb_months)
p2=pylab.bar(x,otherMonths[-numb_months:],width,color='green',align='center')
p1=pylab.bar(x,vfMonths[-numb_months:],width,color='orange',align='center')



pylab.xticks(x, monthsPretty[lastMonth-8:lastMonth],rotation=20)

pylab.legend( (p1[0], p2[0]), ('VF', 'other') )
#Decorating the plot
decoratePlot(xsize=16,ysize=16)
pylab.savefig('month.png')


# Generate latex-file.

output=Pdf('VF-report.tex')

print startMonth
output.titleVf('VF reporting form from the period '+str(startDay)+' '+monthsArray[startMonth-1]+' '+str(startYear)+' - '+str(endDay)+' '+monthsArray[endMonth-1]+' '+str(endYear))
vf=numpy.zeros(6,int)
other=numpy.zeros(6,int)
vf[0]=vfNumber
other[0]=otherNumber
vf[1]=vfArv
other[1]=otherArv
vf[2:]=vfWho
other[2:]=otherWho
output.vfWhoTable(vf,other,missing)

output.vfPlots()
output.ptable(meanVf,meanOther,p_value)
output.close()

os.system('pdflatex VF-report.tex')
os.remove('year.png')
os.remove('month.png')
os.remove('who.png')
os.remove('src.png')
os.remove('VF-report.tex')
os.remove('VF-report.aux')
os.remove('VF-report.log')
