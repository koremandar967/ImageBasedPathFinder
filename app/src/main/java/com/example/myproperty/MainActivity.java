package com.example.myproperty;

import java.net.URLEncoder;
import java.util.Timer;
import java.util.TimerTask;

import org.apache.http.client.HttpClient;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.DefaultHttpClient;

import android.os.Bundle;
import android.os.StrictMode;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import android.view.MenuItem;
import android.view.View.OnClickListener;
import android.view.View;

public class MainActivity extends Activity {

	long Delay = 7000;
	Timer timer;
	MyTimerTask myTimerTask;
	android.widget.LinearLayout.LayoutParams layoutparams;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		
		
		if (android.os.Build.VERSION.SDK_INT > 9) {
		    StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
		    StrictMode.setThreadPolicy(policy);
		}
		

		
		
	    timer = new Timer();
	    myTimerTask = new MyTimerTask();
	    timer.schedule(myTimerTask, 3000);
	    
	}

	public void callpage()
	{
		Intent intent=new Intent(getApplicationContext(),MenuActivity.class);
		startActivity(intent);
		finish();
	}
	
	 class MyTimerTask extends TimerTask {

		  @Override
		  public void run() {
		   
		   runOnUiThread(new Runnable(){

		    @Override
		    public void run() {
		    	callpage();
		    	
		    }});
		  }
		  
		 }

	
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}

}
