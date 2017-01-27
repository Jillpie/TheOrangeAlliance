#! /usr/bin/python

import time

print 'hi'

counter = 0 


while True:

	localtime = time.asctime( time.localtime(time.time()) )
	print "Local current time :", localtime
	
	print 'start of loop'
	counter = counter + 1
	print 'loop number: ' , str(counter)
	time.sleep(10)

	file = open("testfile.txt","w")
	print 'file opened '
	file.write(str(counter))
 
	file.write('Hello World') 
	file.write('Why? Because we can.') 
	print 'file about to close'
	file.close()
	print 'file close'