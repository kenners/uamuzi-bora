from report_templates import *




#Connect to the database

# get data
today=date.today()
year=today.year

maleU14=db.query("SELECT pid FROM patients WHERE sex='Male' and year_of_birth >="+str(year-14)).getresult()
femaleU14 =db.query("select pid from patients WHERE sex='Female' and year_of_birth >="+str(year-14)).getresult()
maleO14=db.query("select pid from patients WHERE sex='Male' and year_of_birth <"+str(year-14)).getresult()
femaleO14=db.query("select pid from patients WHERE sex='Female' and year_of_birth <"+str(year-14)).getresult()


#ARRAYS OF FIELDS BY TEST TO GO HERE


maleU14Who=[0,0,0,0]
femaleU14Who=[0,0,0,0]
maleO14Who=[0,0,0,0]
femaleO14Who=[0,0,0,0]
maleU14Src=[0,0,0,0,0,0,0,0,0]
femaleU14Src=[0,0,0,0,0,0,0,0,0]
maleO14Src=[0,0,0,0,0,0,0,0,0]
femaleO14Src=[0,0,0,0,0,0,0,0,0]
maleU14Yr=[]
femaleU14Yr=[]
maleO14Yr=[]
femaleO14Yr=[]
for i in maleU14:
    
    res=db.query("SELECT hiv_positive_who_stage, patient_source_id FROM medical_informations WHERE pid="+str(i[0])+' AND '+transDate).getresult()
    
    resYr=db.query("SELECT hiv_positive_clinic_start_date FROM medical_informations WHERE pid="+str(i[0])).getresult()
    yr=resYr[0][0]
    if yr != None:
            maleU14Yr.append(yr[0:7])
    if res!= []:
        who=res[0][0]
        src=res[0][1]
        
            
        if who!= None:
            maleU14Who[who-1]+=1
        if src != None:
            maleU14Src[src-1]+=1
        
        
for i in femaleU14:
    
    res=db.query("SELECT hiv_positive_who_stage,patient_source_id FROM medical_informations WHERE pid="+str(i[0])+' AND '+transDate).getresult()
    resYr=db.query("SELECT hiv_positive_clinic_start_date  FROM medical_informations WHERE pid="+str(i[0])).getresult()
    yr=resYr[0][0]
    if yr != None:
            femaleU14Yr.append(yr[0:7])
    if res!=[]:
    
        who=res[0][0]
        src=res[0][1]
       
        if who!= None:
            femaleU14Who[who-1]+=1
        if src != None:
           femaleU14Src[src-1]+=1

        
for i in maleO14:

    res=db.query("SELECT hiv_positive_who_stage,patient_source_id FROM medical_informations WHERE pid="+str(i[0])+' AND '+transDate).getresult()
    resYr=db.query("SELECT hiv_positive_clinic_start_date  FROM medical_informations WHERE pid="+str(i[0])).getresult()
    yr=resYr[0][0]
    if yr != None:
            maleO14Yr.append(yr[0:7])
    if res!=[]:
    
        who=res[0][0]
        src=res[0][1]
       
        if who!= None:
            maleO14Who[who-1]+=1
        if src != None:
            maleO14Src[src-1]+=1

   
for i in femaleO14:
    
    res=db.query("SELECT hiv_positive_who_stage,patient_source_id FROM medical_informations WHERE pid="+str(i[0])+' AND '+transDate).getresult()
    resYr=db.query("SELECT hiv_positive_clinic_start_date  FROM medical_informations WHERE pid="+str(i[0])).getresult()
    yr=resYr[0][0]
    if yr != None:
            femaleO14Yr.append(yr[0:7])
    if res != []:
        
        who=res[0][0]
        src=res[0][1]
        
        if who!= None:
            femaleO14Who[who-1]+=1
        if src != None:
            femaleO14Src[src-1]+=1
       
        
print maleU14Src

years=[]
months=[]

for i in [maleO14Yr,femaleO14Yr,maleU14Yr,femaleU14Yr]:
    for n in i:
        
        year=n[0:4]
        if  year not in years:
            
            years.append(year)
            
        m =n[0:7]
        
        if  m not in months:
           
            months.append(m)

femaleU14MPlot=[]
femaleO14MPlot=[]
maleU14MPlot=[]
maleO14MPlot=[]

femaleU14YPlot=[]
femaleO14YPlot=[]
maleU14YPlot=[]
maleO14YPlot=[]
years.sort()
months.sort()
for i in years:
    tot=0
    for n in maleU14Yr:
        if n[0:4]==i:
            tot+=1
    maleU14YPlot.append(tot)
    tot=0
    for n in femaleU14Yr:
        if n[0:4]==i:
            tot+=1
    femaleU14YPlot.append(tot)
    tot=0
    for n in maleO14Yr:
        if n[0:4]==i:
            tot+=1
    maleO14YPlot.append(tot)
    tot=0
    for n in femaleO14Yr:
        if n[0:4]==i:
            tot+=1
    femaleO14YPlot.append(tot)

for i in months:
    tot=0
    for n in maleU14Yr:
        
        if n==i:
            tot+=1
    maleU14MPlot.append(tot)
    tot=0
    for n in femaleU14Yr:
        
        
        if n==i:
            tot+=1

    femaleU14MPlot.append(tot)
    tot=0
    for n in maleO14Yr:
        if n==i:
            tot+=1

    maleO14MPlot.append(tot)
    tot=0
    for n in femaleO14Yr:
       
        if n==i:
            tot+=1
    femaleO14MPlot.append(tot)
    

## PLOTTING:
#Who-stage for all groups
x=numpy.arange(4)

pylab.bar(x+0.1,maleU14Who,width=0.2, color='orange',label= "Male U14")
pylab.bar(x+0.3,femaleU14Who,width=0.2, color='green',label= "Female U14")
pylab.bar(x+0.5,maleO14Who,width=0.2, color='blue',label= "Male O14")
pylab.bar(x+0.7,femaleO14Who,width=0.2, color='gray',label= "Female O14")
pylab.legend(loc=0)
pylab.xticks(x+0.5, ('1', '2', '3', '4' ))
v=list(pylab.axis())
    
v[0]=0
v[1]=4.5
pylab.axis(v)   

#Decorating the plot
decoratePlot()

pylab.savefig('who.png')

#Patient source
pylab.figure()
x=numpy.arange(len(maleU14Src))
pylab.bar(x+0.1,maleU14Src,width=0.2, color='orange',label= "Male U14")
pylab.bar(x+0.3,femaleU14Src,width=0.2, color='green',label= "Female U14")
pylab.bar(x+0.5,maleO14Src,width=0.2, color='blue',label= "Male O14")
pylab.bar(x+0.7,femaleO14Src,width=0.2, color='gray',label= "Female O14")
pylab.legend(loc=0)
pylab.xticks(x+0.5, ('PMTCT','IP', 'VCT','CWC','TB OPD', 'VF','OPD','PITC', 'Other' ),rotation=20)
v=list(pylab.axis())
    
v[0]=0
v[1]=9.5
pylab.axis(v)

#Decorating the plot
decoratePlot(xsize=16)

pylab.savefig('src.png')

#Years
pylab.figure()
x=numpy.arange(len(years))
if len(years)==0:
    x=numpy.arange(1)
    maleU14YPlot=[0]
    femaleU14YPlot=[0]
    maleO14YPlot=[0]
    femaleO14YPlot=[0]

pylab.bar(x+0.1,maleU14YPlot,width=0.2, color='orange',label= "Male U14")
pylab.bar(x+0.3,femaleU14YPlot,width=0.2, color='green',label= "Female U14")
pylab.bar(x+0.5,maleO14YPlot,width=0.2, color='blue',label= "Male O14")
pylab.bar(x+0.7,femaleO14YPlot,width=0.2, color='gray',label= "Female O14")
pylab.legend(loc=0)
pylab.xticks(x+0.5, years)
v=list(pylab.axis())
    
v[0]=0
pylab.axis(v)    

#Decorating the plot
decoratePlot()

pylab.savefig('year.png')



#Months
monthsPretty=[]
numberMonth=8 # Number of months to display
lastMonth=0
for month in months:
    year,m=month.split('-')
   
    if  year<endYear:
        lastMonth+=1
    elif year==endYear and m<endMonth:
        lastMonth+=1
        
    monthsPretty.append(monthsArray[int(m)-1]+' '+year)
pylab.figure()



start=lastMonth-numberMonth
if lastMonth<numberMonth:
    start=0
    lastMonth=None
    numberMonth=len(months)
if len(months)==0:
    maleU14MPlot=[0]
    femaleU14Mplot=[0]
    maleO14Mplot=[0]
    femaleO14Mplot=[0]
    numberMonth=1
    monthsPretty=['No data']
x=numpy.arange(numberMonth)

pylab.bar(x+0.1,maleU14MPlot[start:lastMonth],width=0.2, color='orange',label= "Male U14")
pylab.bar(x+0.3,femaleU14MPlot[start:lastMonth],width=0.2, color='green',label= "Female U14")
pylab.bar(x+0.5,maleO14MPlot[start:lastMonth],width=0.2, color='blue',label= "Male O14")
pylab.bar(x+0.7,femaleO14MPlot[start:lastMonth],width=0.2, color='gray',label= "Female O14")
pylab.legend(loc=0)
pylab.xticks(x+0.5, monthsPretty[start:lastMonth] ,rotation=20)

v=list(pylab.axis())
  
v[0]=0
pylab.axis(v)    

#Decorating the plot
decoratePlot(xsize=16)

pylab.savefig('month.png')



# Generate latex-file.
filename='MoH-report'+startDay+startMonth+startYear+'-'+endDay+endMonth+endYear
output=Pdf(filename+'.tex')

output.titleMoh('MoH 257 health facility reporting form ( '+startDay+' '+monthsArray[startMonthI-1]+' '+startYear+' to '+endDay+' '+monthsArray[endMonthI-1]+' '+endYear+')')

output.mohWhoTable(maleU14Who,maleO14Who,femaleU14Who,femaleO14Who)

output.mohSrcTable(maleU14Src,maleO14Src,femaleU14Src,femaleO14Src)
output.mohPlots()

output.close()

os.system('pdflatex '+filename+'.tex')
os.remove('year.png')
os.remove('month.png')
os.remove('who.png')
os.remove('src.png')
os.remove(filename+'.tex')
os.remove(filename+'.aux')
os.remove(filename+'.log')
