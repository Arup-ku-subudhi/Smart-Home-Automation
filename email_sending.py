import smtplib
import random as r
import MySQLdb as msql

def g_otp():
    t = str(r.randint(0,9))+str(r.randint(0,9))+str(r.randint(0,9))+str(r.randint(0,9))+str(r.randint(0,9))+str(r.randint(0,9))
    return t

def send_msg(msg,msg2):
    msg = "Sorry to inturrupt! Your "+str(msg)+" is turned on for "+str(msg2)+" minute."
    server = smtplib.SMTP_SSL("smtp.gmail.com",465)

    server.login("MailId-1","Mail Password")
    server.sendmail("MailId-2" , "Password",msg)
    server.quit()

def send_otp():
    t = g_otp()
    server = smtplib.SMTP_SSL("smtp.gmail.com",465)
    msg = "Your one time OTP is "+t
    server.login("MailId-1","Password")
    server.sendmail("MailId-1" , "MailId-2",msg)
    server.quit()
    
    conn = msql.connect(user='root', password='', host='localhost', database='smarthome')
    cursor = conn.cursor()
    sql1 = '''UPDATE operate SET gotp=0 WHERE Id=11'''
    
    print(cursor.execute(sql1))
    conn.commit()    
    sql = '''UPDATE login SET otp='''+str(t)+''' WHERE id=11'''
    print(cursor.execute(sql))
    conn.commit()
    print('msg sent'+msg)
    conn.close()
