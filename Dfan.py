import time as current_time
import email_sending as send_mail
import MySQLdb as msql

c_hr = current_time.localtime().tm_hour     #Fetch Current Hour local area
c_min = current_time.localtime().tm_min     #Fetch Current minute local area
st = 1                                      # Used to sending email only one time

def f_duration(i):                          # For Fan Alert Duration
    global c_hr,c_min,st
    d_hr,d_min = 0,0

    if(i[5]!=0):
        d_hr = c_hr + int(i[5]/60)          # Define Duration Hour
        d_min = c_min + int(i[5]%60)        # Define Duration Minute
    if(i[2] == 1):                          # Check Fan is ON
        if(d_hr == current_time.localtime().tm_hour and d_min == current_time.localtime().tm_min):  # Check Duration time with current time
            if(st==1):
                if(i[7]==1):
                    conn = msql.connect(user='root', password='', host='127.0.0.1', database='smarthome')
                    cursor = conn.cursor()
                    sql = '''UPDATE operate SET Fan=0 WHERE Id=11'''
                    cursor.execute(sql)
                    conn.commit()
                    conn.close()
                send_mail.send_msg("Fan",i[5])  # Call the funtion[send_msg()] of "email_sendi.Py" File
                st = 0
    if(i[2]==0):                             # Check Fan is OFF
        c_hr = current_time.localtime().tm_hour
        c_min = current_time.localtime().tm_min
        st = 1