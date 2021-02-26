# Connect smart_home.py In Raspi

import paho.mqtt.publish as publish
import paho.mqtt.client as mqtt
import MySQLdb as msql
import time as current_time
import Dlight
import Dfan
import Ddoor
import email_sending as es

MQTT_SERVER = "<RaspberryPi IP>"
MQTT_PATH = "test_channel"
usr='UserName'
psw="Pass"
i=11
st="000"
def check():
        conn = msql.connect(user='root', password='', host='127.0.0.1', database='smarthome')
        cursor = conn.cursor()
        sql='''SELECT * from operate'''
        cursor.execute(sql)
        result = cursor.fetchone()
        b=result
        c_hr = current_time.localtime().tm_hour     # Fetch Current Hour local area
        c_min = current_time.localtime().tm_min     # Fetch Current minute local area
        c_sec = current_time.localtime().tm_sec
        st1,st2,st3 = 1,1,1
        if b[1] == 1:
            if(c_hr == 23 and c_min == 59 and c_sec ==58):
                sql = '''UPDATE operate SET Light=0 WHERE Id=11'''
                cursor.execute(sql)
                st1 = 0
        if st1 == 0:
            if(c_hr == 00 and c_min == 00 and c_sec == 1):
                sql = '''UPDATE operate SET Light=1 WHERE Id=11'''
                cursor.execute(sql)
                st1 = 1
        if b[2] == 1:
            if(c_hr == 23 and c_min == 59 and c_sec ==58):
                sql = '''UPDATE operate SET Fan=0 WHERE Id=11'''
                cursor.execute(sql)
                st2 = 0
        if st2 == 0:
            if(c_hr == 00 and c_min == 00 and c_sec == 1):
                sql = '''UPDATE operate SET Fan=1 WHERE Id=11'''
                cursor.execute(sql)
                st2 = 1
        if b[3] == 1:
            if(c_hr == 23 and c_min == 59 and c_sec ==58):
                sql = '''UPDATE operate SET Door=0 WHERE Id=11'''
                cursor.execute(sql)
                st3 = 0
        if st3 == 0:
            if(c_hr == 00 and c_min == 00 and c_sec == 1):
                sql = '''UPDATE operate SET Door=1 WHERE Id=11'''
                cursor.execute(sql)
                st3 = 1
        conn.close()
        return b
        
while True:
        i=check()   # fetch the status of Light(i[1]), Fan(i[2]), Door(i[3])
        i=str(i[1])+str(i[2])+str(i[3])
        if(i != st):
            publish.single(MQTT_PATH, i , hostname=MQTT_SERVER,auth={'username':'UserName', 'password':'Password'}) #Send the Light,Fan,Door Status to RPi
            st = i
            i=check()
            Dlight.l_duration(i)
            Dfan.f_duration(i)
            Ddoor.d_duration(i)
        i = check()
        if i[8]==1:
            es.send_otp()

def on_connect(client,userdata,flags,rc):
        print("Connected with code "+str(rc))
        client.subscribe("test")
        
def on_message(client,userdata,msg):
        print("Message received->"+msg.topic+" "+str(msg.payload))

client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message
client.username_pw_set(usr,psw)
client.connect('127.0.0.1',1883)
client.loop_forever()






'''elif(i[1]==0):
    publish.single(MQTT_PATH, "LedOff", hostname=MQTT_SERVER,auth={'username':'dave', 'password':'arup#kumar99'})
if(i[2]==1):
    publish.single(MQTT_PATH, "FanOn", hostname=MQTT_SERVER,auth={'username':'dave', 'password':'arup#kumar99'})
elif(i[2]==0):
    publish.single(MQTT_PATH, "FanOff", hostname=MQTT_SERVER,auth={'username':'dave', 'password':'arup#kumar99'})
if(i[3]==1):
    publish.single(MQTT_PATH, "DoorOn", hostname=MQTT_SERVER,auth={'username':'dave', 'password':'arup#kumar99'})
elif(i[3]==0):
    publish.single(MQTT_PATH, "DoorOff", hostname=MQTT_SERVER,auth={'username':'dave', 'password':'arup#kumar99'})
    ''' 
