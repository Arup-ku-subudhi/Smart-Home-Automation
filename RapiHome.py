import paho.mqtt.client as mqtt
import paho.mqtt.publish as publish
import time
import RPi.GPIO as gpio
from test2 import fan

MQTT_SERVER = "IPAddress"
MQTT_PATH = "TOPIC"
usr = 'USER_Name'
psw = "Password"
isDoorOpen,isLightOn,isFanOn = False,False,False

gpio.setmode(gpio.BCM)
gpio.setup(4,gpio.OUT)
gpio.setup(24,gpio.OUT)

#This Function is used to turn on/off the Door
def door(a):   
    try:
        pwm1=gpio.PWM(24,100)
        pwm1.start(5)    
        duty = a/18+2
        gpio.output(24,True)
        pwm1.ChangeDutyCycle(duty)
        time.sleep(1)
        gpio.output(24,False)
        pwm1.ChangeDutyCycle(0)
        pwm1.stop()
        #gpio.cleanup()
    except:
        print("Error during door fun")

def LedOnOff(a):
    gpio.output(4,False)
    if(a==0):
        gpio.output(4,False)
    elif(a==1):
        gpio.output(4,True)
        
def on_connect(client,userdata,flags,rc):
    print("Connected with code "+str(rc))
    client.subscribe("test_channel")

def on_message(client,userdata,msg):
    #print("Message received->"+msg.topic+" "+str(msg.payload))
    #publish.single(MQTT_PATH,"Led is turned off",hostname=MQTT_SERVER,auth={'username':'dave','password':'arup#kumar99'})
    global isDoorOpen,isLightOn,isFanOn
    s=str(msg.payload)
    f=1
    if(s[2]=='0' and isLightOn==True):
        isLightOn=False
        LedOnOff(0)
        #print('loff')
    elif(s[2]=='1' and isLightOn==False):
        isLightOn=True
        LedOnOff(1)
        #print('lon')
    if(s[3]=='0' and isFanOn==True):
        isFanOn=False
        fan(0)
    elif(s[3]=='1' and isFanOn==False):
        isFanOn=True
        fan(1)
    if s[4]=='0' and isDoorOpen == True:
        door(180)
        isDoorOpen = False
        #print('doff')
    elif s[4]=='1' and isDoorOpen == False:
        door(0)
        isDoorOpen = True
        #print('don')

client = mqtt.Client()
client.on_connect = on_connect
client.on_message = on_message
client.username_pw_set(usr,psw)
client.connect('127.0.0.1',1883)
client.loop_forever()
