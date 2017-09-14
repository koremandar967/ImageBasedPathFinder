# Image Based Path Finder
It is a hybrid mobile application which finds the path with the help of Google maps by taking an images of location as an input and display the route from source to destination in the application itself.

##What are the Objectives of this project ?

* The main function of application is finding routes from source place to destination place by matching images.
* To identify the Source image and Destination image with the image stored in the database with its latitude and
  longitude
* Mapping of possible routes to the destination with the help of Google API.

## Used Algorithms

* Perceptual Hash Algorithm.
* Edge Detection Algorithm.

### Implementing this application
----------------------------------

For implementing Hybrid application in order to fetch the content of the webview of android application web files and android application should be connected in same network i.e. same I.P. Before implementing this application IP address should be changed in several files and also java files of android application.

 In the **UploadToserver.php** and **UploadToserversd.php** file change I.P address with respect to your network congfiguration

 ```if($lat1>=1.0 and $log1>=1.0)
  {
	echo "<script> location.href=\"http://192.168.43.2/ImageMap/MyTracklocation.php?LAT=$lat&LOG=$log&LAT1=$lat1&LOG1=$log1\";</script>";
  }
  ```

In Android Application **Fileupload.java**, **Fileuploadsd.java** and **GPSActivity.java** change I.P address with respect to your network congfiguration

```try
 {	   
	Lat = URLEncoder.encode(Lat, "UTF-8");
	Log = URLEncoder.encode(Log, "UTF-8");			
	w1.loadUrl("http://192.168.43.42/ImageMap/MyLocation.php?Lat="+Lat+"&Log="+Log);
 }
 catch(Exception w){}
 ```

 > When android application and admin are connected in same network then in android application current location
   latitude and longitude is displayed as a toast.
    