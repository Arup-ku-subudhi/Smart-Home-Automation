import time as current_time
import email_sending as send_mail
import MySQLdb as msql

c_hr = current_time.localtime().tm_hour     # Fetch Current Hour local area
c_min = current_time.localtime().tm_min     # Fetch Current minute local area
st = 1                                        # Used to sending email only one time

def l_duration(i):                          # For Light Alert Duration
    global c_hr,c_min,st
    d_hr,d_min = 0,0
    if(i[4]!=0):
        d_hr = c_hr + int(i[4]/60)          # Define Duration Hour
        d_min = c_min + int(i[4]%60)        # Define Duration Minute
    if(i[1]==1):                            # Check Light is ON
        if(d_hr == current_time.localtime().tm_hour and d_min == current_time.localtime().tm_min):  # Check Duration time with current time
            if(st==1):
                if(i[7]==1):
                    conn = msql.connect(user='root', password='', host='127.0.0.1', database='smarthome')
                    cursor = conn.cursor()
                    sql = '''UPDATE operate SET Light=0 WHERE Id=11'''
                    cursor.execute(sql)
                    conn.commit()
                    
                    # sql = '''UPDATE light_tb SET OTime='''+ current_time.localtime() +''' WHERE Id=11'''
                    # cursor.execute(sql)
                    # conn.commit()
                    
                    conn.close()
                send_mail.send_msg("Light",i[4])    # Call the funtion[send_msg()] of "email_sendi.Py" File
                st=0
    if(i[1]==0):                            # Check Light is OFF
        c_hr = current_time.localtime().tm_hour
        c_min = current_time.localtime().tm_min
        st=1