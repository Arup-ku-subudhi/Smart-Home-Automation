import RPi.GPIO as gpio
#gpio.cleanup()

gpio.setmode(gpio.BCM)
gpio.setup(25,gpio.OUT) # PIN 22
gpio.setup(26,gpio.OUT)# PIN 37
gpio.setup(19,gpio.OUT)# PIN 35

p=gpio.PWM(25,1000)  # Full Power 1000
p.start(25)
def fan(a):
    if(a==1):
        gpio.output(26,gpio.HIGH)
        gpio.output(19,gpio.LOW)
    else:
        gpio.output(26,gpio.LOW)
        gpio.output(19,gpio.LOW)
#gpio.cleanup()
#while 1:
#fan(1)

