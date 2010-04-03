import os
os.environ['HOME'] = os.getcwd()+'/output'
import matplotlib
matplotlib.use('Agg')
import pylab
import pg
import numpy
import scipy.stats as stats
from datetime import date
import sys
sys.path.append('dbConfig' )
outputFolder='output'
monthsArray=['Jan','Feb','March','April','May','June','Juli','Aug','Sept','Okt','Nov','Des']
pathDbConfig='../../config/database.php'
if os.path.isfile('dbConfig/dbConfig.py'):
    
    
    from dbConfig import *
    
else:
    f=open(pathDbConfig,'r')
    for i in f:
        s=i.split(' ')
        if len(s)>3:
            
            
            if s[1]=='$default':
                break
        
    f.next()
    f.next()
    
    host=f.next().split(' ')[2].split(',')[0]
    login=f.next().split(' ')[2].split(',')[0]
    password=f.next().split(' ')[2].split(',')[0]
    database=f.next().split(' ')[2].split(',')[0]
    
    if host=='NULL':
        host='None'
    if login=='NULL':
        login='None'
    if password=='NULL':
        password='None'
    if database=='NULL':
        database='None'

   
    f.close()
    f=open('dbConfig/dbConfig.py','w')
    f.write('host = '+host+'\n')
    f.write('login = '+login+'\n')
    f.write('password = '+password+'\n')
    f.write('database = '+database+'\n')
    f.close()
    
    from dbConfig import *
db=pg.connect(database,host,-1,None,None,login,password)

os.chdir(outputFolder)

#Access the command line arguments to determine the period for which to generate the report.
if len(sys.argv)>1:
    start=sys.argv[1]
else:
    #set the start point befor
    start=None
if len(sys.argv)>2:
    end=sys.argv[2]
else:
    end=date.today()
startYear,startMonth,startDay=start.split('-')
endYear,endMonth,endDay=end.split('-')
#Format days,months for nice output
startYearI=int(startYear)
startMonthI=int(startMonth)
startDayI=int(startDay)
endDayI=int(endDay)
endMonthI=int(endMonth)
endYearI=int(endYear)

transDate="art_start_date > TIMESTAMP '"+start+" 00:00:00 ' AND art_start_date < TIMESTAMP '"+end+" 00:00:00'"
createdCond='created > '+start+' AND created < '+end


#LATEX-stuff

header='''
\documentclass[twocolumn]{revtex4}
\usepackage{graphics,graphicx}

\\begin{document}

\\textheight=24.75cm

\\hfill


'''
end='''
\\clearpage
\end{document}
'''



class Pdf:
    def __init__(self,filename):
        self.file=open(filename,'w')
        self.file.write(header)
    def titleVf(self,title):
        self.file.write('\\title{\\includegraphics[width=3cm]{ubbanner.png}'+title+'\\includegraphics[width=3cm]{vf.png}}\n ')
        
        self.file.write('\date{\\today}\n')
        self.file.write('\\maketitle\n')

    def titleMoh(self,title):
        self.file.write('\\title{\\includegraphics[width=2cm]{ubbanner.png}'+title+'}\n ')
        
        self.file.write('\date{\\today}\n')
        self.file.write('\\maketitle\n')
    def text(self,text):
        self.file.write(text)

    def close(self):

        self.file.write(end)
        self.file.close()
    def vfWhoTable(self,vf,other,missing):
        total=vf+other
        self.file.write('''
\\begin{table}[p!]
\caption{Numbers enrolled in HIV care, by WHO stage, by Patient Source}
\\begin{tabular}{l l l l}
\hline
Patient Source  &VF & Other & Total\\\\ [0.5 ex]
\hline
'''
                        )
        self.file.write('No. enrolled& '+str(vf[0])+'&'+str(other[0])+'&'+str(total[0])+'\\\\ \n')
        self.file.write('No on ARVs& '+str(vf[1])+'&'+str(other[1])+'&'+str(total[1])+'\\\\')
        for i in range(1,5):
            self.file.write('WHO stage '+str(i)+'&'+str(vf[1+i])+'&'+str(other[1+i])+'&'+str(total[1+i])+'\\\\ \n')
        self.file.write('Missing &'+str(missing[0])+'&'+str(missing[1])+'&'+str(missing[0]+missing[1])+'\\\\ \n')
        self.file.write('''
\\botrule
\label{tab:1}
\end{tabular}
\end{table}
        '''
                        )

    def vfSiteTable(self,loc,number):
        self.file.write('''
\\begin{table}[p!]
\caption{Numbers enrolled, by VF testing site}
\\begin{tabular}{l l}
\hline
VF site &Numbers enrolled\\\\ [0.5 ex]
\hline
\\\\
'''
                        )
        for i in range(len(loc)):
            self.file.write(loc[i]+'&'+str(number[i])+"\\\\ \n")
        self.file.write('''
\\botrule
\label{tab:1}
\end{tabular}
\end{table}

'''
                        )

    def vfPlots(self):
        self.file.write('''
\\begin{figure}[p!]
\\begin{center}
\setlength\\fboxsep{0pt}
\setlength\\fboxrule{0.5pt}
\\fbox{\includegraphics[width=7cm]{who.png}}
\caption{Numbers enrolled in HIV care, by WHO stage, by Patient Source}
\label{fig:1}
\end{center}
\end{figure}

\\begin{figure}[p!]
\\begin{center}
\setlength\\fboxsep{0pt}
\setlength\\fboxrule{0.5pt}
\\fbox{\includegraphics[width=7cm]{src.png}}
\caption{Numbers enrolled in HIV care, by Patient Source}
\label{fig:2}
\end{center}
\end{figure}

\\begin{figure}[p!]
\\begin{center}
\setlength\\fboxsep{0pt}
\setlength\\fboxrule{0.5pt}
\\fbox{\includegraphics[width=7cm]{year.png}}
\caption{Numbers enrolled in HIV care, by year}
\label{fig:3}
\end{center}
\end{figure}

\\begin{figure}[p!]
\\begin{center}
\setlength\\fboxsep{0pt}
\setlength\\fboxrule{0.5pt}
\\fbox{\includegraphics[width=7cm]{month.png}}
\caption{Numbers enrolled in HIV care, by month}
\label{fig:4}
\end{center}
\end{figure}
 '''
                        )
    def ptable(self,mean1,mean2,p_value):
        self.file.write('''
\\begin{table}[p!]
\caption{Mean CD4 count of patients, by paitent source, with t-test for significance}
\\begin{tabular}{l l l}
\hline
Patient Source & VF & Other\\\\ [0.5 ex]
\hline
CD4 count & 
'''
                        )

        self.file.write( ' %6.3f & %6.3f \\\\'%(mean1, mean2))
        self.file.write('P value: %5.4f &&\\\\'%(p_value))
        self.file.write('''
\\botrule
\label{tab:1}
\end{tabular}
\end{table}


'''
                        )
    def mohWhoTable(self,mu14,mo14,fu14,fo14):
        total=numpy.array(mu14)+numpy.array(mo14)+numpy.array(fu14)+numpy.array(fo14)

        self.file.write('''
\\begin{table}[p!]
\caption{Numbers enrolled in HIV care, by WHO stage, by Age and Sex}
\\begin{tabular}{p{1 cm} l l l l l}
\hline
WHO stage  &Male $ <$ 14 & Male $>$ 14 &Female $<$ 14 & Female $>$ 14& Total\\\\ [0.5 ex]
\hline
'''
                        )

        for i in range(0,4):
            self.file.write(str(i+1)+'&'+str(mu14[i])+'&'+str(mo14[i])+'&'+str(fu14[i])+'&'+str(fo14[i])+'&'+str(total[i])+'\\\\ \n')
        self.file.write('''
\\botrule
\label{tab:1}
\end{tabular}
\end{table}
        ''' )
    def mohSrcTable(self,mu14,mo14,fu14,fo14):
        total=numpy.array(mu14)+numpy.array(mo14)+numpy.array(fu14)+numpy.array(fo14)
        src=['Inpatient','VCT','VF','Other']
        self.file.write('''
\\begin{table}[p!]
\caption{Numbers enrolled in HIV care, by Patient Source , by Age and Sex}
\\begin{tabular}{p {1.5 cm} l l l l l}
\hline
Patient Source  &Male $<$ 14 & Male $>$ 14 &Female $<$ 14 & Female $>$ 14 & Total\\\\ [0.5 ex]
\hline
'''
                            )
        for i in range(0,4):
            self.file.write(src[i]+'&'+str(mu14[i])+'&'+str(mo14[i])+'&'+str(fu14[i])+'&'+str(fo14[i])+'&'+str(total[i])+'\\\\ \n')
        self.file.write('''
\\botrule
\label{tab:2}
\end{tabular}
\end{table}
        ''' )
    def mohPlots(self):
        self.file.write('''
\\begin{figure}[p!]
\\begin{center}
\setlength\\fboxsep{0pt}
\setlength\\fboxrule{0.5pt}
\\fbox{\includegraphics[width=7cm]{month.png}}
\caption{Numbers enrolled in HIV care, by month , age, sex}
\label{fig:4}
\end{center}
\end{figure}

\\begin{figure}[p!]
\\begin{center}
\setlength\\fboxsep{0pt}
\setlength\\fboxrule{0.5pt}
\\fbox{\includegraphics[width=7cm]{who.png}}
\caption{Numbers enrolled in HIV care, by WHO stage, sex, age}
\label{fig:1}
\end{center}
\end{figure}

\\begin{figure}[p!]
\\begin{center}
\setlength\\fboxsep{0pt}
\setlength\\fboxrule{0.5pt}
\\fbox{\includegraphics[width=7cm]{src.png}}
\caption{Numbers enrolled in HIV care, by Patient Source, age, sex}
\label{fig:2}
\end{center}
\end{figure}

\\begin{figure}[p!]
\\begin{center}
\setlength\\fboxsep{0pt}
\setlength\\fboxrule{0.5pt}
\\fbox{\includegraphics[width=7cm]{year.png}}
\caption{Numbers enrolled in HIV care, by year, age, sex}
\label{fig:3}
\end{center}
\end{figure}


 '''
                            )



            

def decoratePlot(legsize=20,xsize=20,ysize=20):
    
    leg=pylab.gca().get_legend()
    
    txt=leg.get_texts()
    pylab.setp(txt, fontsize=legsize)
    xticklabels = pylab.getp(pylab.gca(), 'xticklabels')
    yticklabels = pylab.getp(pylab.gca(), 'yticklabels')
    pylab.setp(yticklabels, fontsize=ysize)
    pylab.setp(xticklabels, fontsize=xsize)


