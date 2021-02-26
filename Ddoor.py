import time as current_time
import email_sending as send_mail
import MySQLdb as msql

c_hr = current_time.localtime().tm_hour   #Fetch Current Hour local area
c_min = current_time.localtime().tm_min   #Fetch Current minute local area
st = 1

def d_duration(i):     # For Door Alert Duration
    global c_hr,c_min,st
    d_hr,d_min = 0,0
    if(i[6] != 0):
        d_hr = c_hr + int(i[6]/60)
        d_min = c_min + int(i[6]%60)
    if(i[3]==1):
        if(d_hr == current_time.localtime().tm_hour and d_min == current_time.localtime().tm_min):
            if(st==1):
                if(i[7]==1):
                    conn = msql.connect(user='root', password='', host='127.0.0.1', database='smarthome')
                    cursor = conn.cursor()
                    sql = '''UPDATE operate SET Door=0 WHERE Id=11'''
                    cursor.execute(sql)
                    conn.commit()
                    conn.close()
                send_mail.send_msg("Door",i[6])
                st=0
    if(i[3]==0):
        c_hr = current_time.localtime().tm_hour
        c_min = current_time.localtime().tm_min
        st=1