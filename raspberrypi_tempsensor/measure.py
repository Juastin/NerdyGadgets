import sys
import getopt
import sense_hat
import time
import datetime
import mysql.connector as mariadb
from mysql.connector import errorcode
sensor_name = 'Temperatuur'
# database connection configuration
dbconfig = {
    'user': 'root',
    'password': '',
    'host': '10.80.17.2',
    'database': 'nerdygadgets',
    'raise_on_warnings': True,
}
# parse arguments
verbose = True
interval = 3# second
try:
    opts, args = getopt.getopt(sys.argv[1:], "vt:")
except getopt.GetoptError as err:
    print(str(err))
    print('measure.py -q -t <interval>')
    print('-q: be quiet')
    print('-t <interval>: measure each <interval> seconds (default: 10s)')
    sys.exit(2)
for opt, arg in opts:
    if opt == '-q':
        verbose = False
    elif opt == '-t':
        interval = int(arg)
# instantiate a sense-hat object
sh = sense_hat.SenseHat()
# infinite loop
try:
    while True:
        # instantiate a database connection
        try:
            mariadb_connection = mariadb.connect(**dbconfig)
            if verbose:
                print("Database connected")
        except mariadb.Error as err:
            if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
                print("Something is wrong with your user name or password")
            elif err.errno == errorcode.ER_BAD_DB_ERROR:
                print("Database does not exist")
            else:
                print("Error: {}".format(err))
            sys.exit(2)
        # create the database cursor for executing SQL queries
        cursor = mariadb_connection.cursor(buffered=True)
        # measure temperature
        temp = round(sh.get_temperature(), 1)
        temp = temp – 30
        tijd = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        # verbose
        if verbose:
            print("Temperature: %s C" % temp)
        # store measurement in coldroomtemperatures database and the
coldroomtemperatures_archive database.
       try:            cursor.execute('DELETE FROM coldroomtemperatures WHERE ColdRoomSensorNumber = 5')
          cursor.execute('INSERT INTO coldroomtemperatures (Temperature,ColdRoomSensorNumber, RecordedWhen, ValidFrom) VALUES (%s, %s, %s, %s);', (temp, 5, tijd, tijd))
            cursor.execute('INSERT INTO coldroomtemperatures_archive (Temperature, ColdRoomSensorNumber, RecordedWhen, ValidFrom, ValidTo) VALUES (%s, %s, %s, %s, %s);', (temp, 5, tijd, tijd, tijd))
except mariadb.Error as err:
 print("Error: {}".format(err))
else:
            # commit measurements
            mariadb_connection.commit()
            if verbose:
                print("Temperature committed")
            # close db connection
            cursor.close()
            mariadb_connection.close()
            time.sleep(interval)
except KeyboardInterrupt:
    pass
# done
