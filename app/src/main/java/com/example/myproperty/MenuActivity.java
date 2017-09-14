package com.example.myproperty;

import java.util.Timer;
import java.util.TimerTask;

import android.os.Bundle;
import android.os.StrictMode;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.Toast;

public class MenuActivity extends Activity {

	protected static final String TAG = null;
	protected static final int HTTP_STATUS_OK = 0;  
	 Timer timer;
	 MyTimerTask myTimerTask;
	 GPSTracker gps;
	 String umob;
		String latitudestr = "";
		String longitudestr ="";
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_menu);
		
		
		if (android.os.Build.VERSION.SDK_INT > 9) {
		    StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
		    StrictMode.setThreadPolicy(policy);
		}
		
		Button b1 =(Button) findViewById(R.id.Menubutton1);
		b1.getBackground().setAlpha(98);
		b1.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View arg0) {
				Intent intent=new Intent(getApplicationContext(),GPSActivity.class);
				intent.putExtra("Lat", latitudestr);
				intent.putExtra("Log", longitudestr);
				startActivity(intent);
			}
		});
		
		Button b2 =(Button) findViewById(R.id.Menubutton2);
		b2.getBackground().setAlpha(98);
		b2.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View arg0) {
				finish();
				//Intent intent=new Intent(getApplicationContext(),MainPropertyActivity.class);
				//startActivity(intent);
			}
		});
		
		Button b3 =(Button) findViewById(R.id.Menubutton3);
		b3.getBackground().setAlpha(98);
		b3.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View arg0) {
				Intent intent=new Intent(getApplicationContext(),Fileupload.class);
				intent.putExtra("Lat", latitudestr);
				intent.putExtra("Log", longitudestr);
				startActivity(intent);
				
			}
		});
		
		Button b4 =(Button) findViewById(R.id.Menubutton4);
		b4.getBackground().setAlpha(98);
		b4.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View arg0) {
				Intent intent=new Intent(getApplicationContext(),Fileuploadsd.class);
				startActivity(intent);
				
			}
		});
		
	    timer = new Timer();
	    myTimerTask = new MyTimerTask();
	    timer.schedule(myTimerTask, 15000, 15000);
 
	    
	}


	 class MyTimerTask extends TimerTask {

		  @Override
		  public void run() {
		   
		   runOnUiThread(new Runnable(){

		    @Override
		    public void run() {
		    	getlocval();
		    	
		    }});
		  }
		  
		 }
	 
	public void getlocval()
	{
		gps = new GPSTracker(MenuActivity.this);
       if(gps.canGetLocation()){
       	
       	double latitude = gps.getLatitude();
       	double longitude = gps.getLongitude();
       	Toast.makeText(getApplicationContext(), "Your Location is - \nLat: " + latitude + "\nLong: " + longitude, Toast.LENGTH_LONG).show();

			latitudestr = Double.toString(latitude);
			longitudestr = Double.toString(longitude);
								
       }else{
       	gps.showSettingsAlert();
       }
	}
	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.menu, menu);
		return true;
	}

}
