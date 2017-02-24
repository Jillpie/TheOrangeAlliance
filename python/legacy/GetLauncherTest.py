#! /usr/bin/python

import time

print 'I'

class LauncherTest(object):
	'I am a Lunacher Class Object Thing'
	def __init__(self):
		print 'hi'
		counter = 0 
		while counter <= 3:
			counter = counter + 1
			print str(counter)
			time.sleep(1)
			print 'hi'

			file = open("/developer/TheOrangeAlliance/python/testfiletesting.txt","w")

			file.write(str(counter))
		 
			file.write('XXX World') 
			file.write('Why? Because we can.') 

			file.close()

instant = LauncherTest()

print 'I2'
