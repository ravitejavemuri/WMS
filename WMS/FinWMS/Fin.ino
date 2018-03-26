
#include <SoftwareSerial.h>
SoftwareSerial gprsSerial(2, 3);//(2)rx,tx

#define sLED 12

int lD;

float pH,cN,con2,con1,ld1,ld2,sam1,sam2;
String str,dat1,dat2;

void setup()
{
  gprsSerial.begin(9600); 
  Serial.begin(9600);
  pinMode(A1,INPUT);// con
  pinMode(A0,INPUT);// ph
  pinMode(A2,INPUT);//LDR
  pinMode(sLED,OUTPUT);// STATUS LED
 
 
  gprsSerial.flush();
  Serial.flush();
  
  digitalWrite(sLED,HIGH);
  // attach or detach from GPRS service 
 
  gprsSerial.println("AT+CGATT?");
  delay(100);
  toSerial();
  
  // bearer settings
  gprsSerial.println("AT+SAPBR=3,1,\"CONTYPE\",\"GPRS\"");
  delay(2000);
  toSerial();

  // bearer settings
  gprsSerial.println("AT+SAPBR=3,1,\"APN\",\"internet\"");
  delay(2000);
  toSerial();

  // bearer settings
  gprsSerial.println("AT+SAPBR=1,1");
  delay(2000);
  toSerial();
    
   // Sim Loc
   gprsSerial.println("AT+CIPGSMLOC=1,1");
   delay(2000); 
   SerialLoc(); 
   // toSerial();
   delay(2000); 
   satusLed();
 
   }


void loop()
{ 
  
 Capture(); 
 
  con1=analogRead(A1);
  delay(1000);
  con2=analogRead(A1);
  cN=con1+con2/2;//avg val conductivity
  Serial.println(cN);
  satusLed();
  
  
  
  delay(5000);
  pH=analogRead(A0);
  // avg val of H
  pH=.0235*(1023-pH);
  delay(1000);
  Serial.println(pH);
  satusLed();
  
  ld1=analogRead(A2);
  delay(2000);
  ld2=analogRead(A2);
  lD=ld1+ld2/2;
 Serial.println(ld1);
  
  satusLed();
  
  //shifted from top
   // initialize http service
  gprsSerial.println("AT+HTTPINIT");
  delay(200); 
  toSerial();
  satusLed();

  // set http param valuehttps://webuildsmartindia.000webhostapp.com/store.php?pH=9.5&Turb=900&Con=100&Lat=17.554363&Long=78.452667
  gprsSerial.println("AT+HTTPPARA=\"URL\",\"http://webuildsmartindia.000webhostapp.com/store.php?pH="+ String(pH)+"&Turb="+ String(lD)+"&Con="+ String(cN)+"&Lat="+ dat1+"&Long="+dat2+"\"");   
  delay(200);
  toSerial();
  satusLed();

  // set http action type 0 = GET, 1 = POST, 2 = HEAD
  gprsSerial.println("AT+HTTPACTION=0");
  delay(600);
  toSerial();
  satusLed();

  // read server response
  gprsSerial.println("AT+HTTPREAD"); 
  delay(100);
  toSerial();
  satusLed();

  // gprsSerial.println("");
  gprsSerial.println("AT+HTTPTERM");
  toSerial();
  delay(300);
  satusLed();
 
}

void toSerial()
{
  while(gprsSerial.available()!=0)
  {
    Serial.write(gprsSerial.read());
  }
}



void SerialLoc()
{
  
  while(gprsSerial.available()!=0)
  {
   str=gprsSerial.readString();
       Serial.print(str);
    
  }
}

void Capture()
{  
   dat2=str.substring(33,42);
   dat1=str.substring(43,52);

Serial.println(dat1);
Serial.println(dat2);
  }

void satusLed()
{
  digitalWrite(sLED,HIGH);
  delay(50);
  digitalWrite(sLED,LOW);
  delay(135);
  digitalWrite(sLED,HIGH);
  delay(50);
  digitalWrite(sLED,LOW);
}

