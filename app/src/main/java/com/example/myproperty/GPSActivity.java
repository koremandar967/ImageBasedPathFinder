package com.example.myproperty;

import java.net.URLEncoder;
import java.util.Timer;
import java.util.TimerTask;

import org.apache.http.client.HttpClient;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.DefaultHttpClient;

import com.example.myproperty.Fileupload.SimpleChromeClient;
import com.example.myproperty.Fileupload.SimpleWebViewClient;

import android.net.Uri;
import android.os.Bundle;
import android.os.StrictMode;
import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.view.KeyEvent;
import android.view.Menu;
import android.view.MenuItem;
import android.webkit.ValueCallback;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings.LayoutAlgorithm;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ProgressBar;
import android.widget.Toast;

public class GPSActivity extends Activity {

   
	String Log="";
	String Lat="";

	WebView w1;
	private ValueCallback<Uri> mUploadMessage;  
	private final static int FILECHOOSER_RESULTCODE=1;
	 private SimpleWebViewClient webViewClient;
	    private SimpleChromeClient chromeClient;
	    
	    @Override  
	    protected void onActivityResult(int requestCode, int resultCode,  
	                                       Intent intent) {  
	     if(requestCode==FILECHOOSER_RESULTCODE)  
	     {  
	      if (null == mUploadMessage) return;  
	               Uri result = intent == null || resultCode != RESULT_OK ? null  
	                       : intent.getData();  
	               mUploadMessage.onReceiveValue(result);  
	               mUploadMessage = null;  
	     }
	     }  
	 
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main_call);

		Lat=getIntent().getExtras().getString("Lat");
		Log=getIntent().getExtras().getString("Log");
		
		w1=(WebView)findViewById(R.id.webViewmylocation);
      	w1.setWebViewClient(new WebViewClient()); 
		w1.getSettings().setJavaScriptEnabled(true);
		
		w1.getSettings().setJavaScriptCanOpenWindowsAutomatically(false);
		w1.getSettings().setLayoutAlgorithm(LayoutAlgorithm.NORMAL);
		 webViewClient = new SimpleWebViewClient();
	        chromeClient = new SimpleChromeClient();
	        w1.setWebViewClient(webViewClient);
	        w1.setWebChromeClient(chromeClient);
	        
		try
	    {	   
			Lat = URLEncoder.encode(Lat, "UTF-8");
			Log = URLEncoder.encode(Log, "UTF-8");			
	    	w1.loadUrl("http://192.168.43.42/ImageMap/MyLocation.php?Lat="+Lat+"&Log="+Log);
	    }
	    catch(Exception w){}
	    
	    w1.setWebViewClient(new WebViewClient() {
	        @Override
		    public void onReceivedError(WebView view, int errorCode,
	                 String description, String failingUrl) {

	        	 w1.loadUrl("about:blank");
	             Toast.makeText(getApplication(), "Oh no! Plz Check Data Connection",Toast.LENGTH_SHORT).show();

	        }
	    });
	    
	    w1.setWebChromeClient(new WebChromeClient()  
	    {  

            
         //The undocumented magic method override  
         //Eclipse will swear at you if you try to put @Override here  
      // For Android 3.0+
      public void openFileChooser(ValueCallback<Uri> uploadMsg) {  

          mUploadMessage = uploadMsg;  
          Intent i = new Intent(Intent.ACTION_GET_CONTENT);  
          i.addCategory(Intent.CATEGORY_OPENABLE);  
          i.setType("image/*");  
          GPSActivity.this.startActivityForResult(Intent.createChooser(i,"File Chooser"), FILECHOOSER_RESULTCODE);  

         }

      // For Android 3.0+
         public void openFileChooser( ValueCallback uploadMsg, String acceptType ) {
         mUploadMessage = uploadMsg;
         Intent i = new Intent(Intent.ACTION_GET_CONTENT);
         i.addCategory(Intent.CATEGORY_OPENABLE);
         i.setType("*/*");
         GPSActivity.this.startActivityForResult(
         Intent.createChooser(i, "File Browser"),
         FILECHOOSER_RESULTCODE);
         }

      //For Android 4.1
         public void openFileChooser(ValueCallback<Uri> uploadMsg, String acceptType, String capture){
             mUploadMessage = uploadMsg;  
             Intent i = new Intent(Intent.ACTION_GET_CONTENT);  
             i.addCategory(Intent.CATEGORY_OPENABLE);  
             i.setType("image/*");  
             GPSActivity.this.startActivityForResult( Intent.createChooser( i, "File Chooser" ), GPSActivity.FILECHOOSER_RESULTCODE );

         }
 
 		 
});
	}

    class SimpleChromeClient extends WebChromeClient {

        private int timeoutCounter = 0;

        public void resetJsTimeout() {
            timeoutCounter = 0;
        }

        @Override
        public void onReceivedTitle(WebView view, String title) {
        	GPSActivity.this.setTitle(title);
        }
    }
    
    class SimpleWebViewClient extends WebViewClient {

        private boolean pageErrorFlag = false;

        @Override
        public void onPageStarted(WebView view, String url, Bitmap favicon) {
            // TODO Auto-generated method stub
            super.onPageStarted(view, url, favicon);
        }

        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url) {
            // TODO Auto-generated method stub

            view.loadUrl(url);
            return true;

        }

        @Override
        public void onPageFinished(WebView view, String url) {
            // TODO Auto-generated method stub
            super.onPageFinished(view, url);

            
        }
        
        @Override
        public void onReceivedError(WebView view, int errorCode, String description,
                String failingUrl) {
            pageErrorFlag = true;
        }
    }
        
	public boolean onKeyDown(int keyCode, KeyEvent event) {
		// Check if the key event was the Back button and if there's history
		if ((keyCode == KeyEvent.KEYCODE_BACK) && w1.canGoBack()) {
		w1.goBack();
		return true;
		}
		// If it wasn't the Back key or there's no web page history, bubble up to the default
		// system behavior (probably exit the activity)
		return super.onKeyDown(keyCode, event);
		}
}
