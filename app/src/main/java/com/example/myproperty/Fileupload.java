package com.example.myproperty;

	import android.os.Bundle;
	import android.app.Activity;
	import android.view.KeyEvent;
	import android.view.Menu;
	import android.webkit.WebView;
	import android.webkit.WebViewClient;
	import android.widget.ProgressBar;
	import java.io.File;
	import java.io.FileNotFoundException;
	import java.io.FileOutputStream;
	import java.io.IOException;
	import java.io.InputStream;
	import java.io.UnsupportedEncodingException;
	import java.net.MalformedURLException;
	import java.net.URL;
	import java.net.URLEncoder;
import java.util.Date;
	import java.util.regex.Pattern;

	import org.apache.http.HttpResponse;
	import org.apache.http.StatusLine;
	import org.apache.http.client.methods.HttpPost;
	import org.apache.http.client.methods.HttpUriRequest;
	import org.apache.http.impl.client.DefaultHttpClient;
	import org.apache.http.message.AbstractHttpMessage;

	import android.net.Uri;
	import android.net.wifi.WifiInfo;
	import android.net.wifi.WifiManager;
	import android.os.Bundle;
	import android.os.Environment;
	import android.os.StrictMode;
	import android.accounts.Account;
	import android.accounts.AccountManager;
	import android.app.Activity;
	import android.content.Context;
	import android.content.Intent;
	import android.graphics.Bitmap;
	import android.telephony.TelephonyManager;
	import android.util.Log;
	import android.util.Patterns;
	import android.view.KeyEvent;
	import android.view.Menu;
import android.view.MenuItem;
	import android.view.View;
	import android.webkit.DownloadListener;
	import android.webkit.ValueCallback;
	import android.webkit.WebChromeClient;
	import android.webkit.WebView;
	import android.webkit.WebViewClient;
	import android.webkit.WebSettings.LayoutAlgorithm;
	import android.widget.ProgressBar;
import android.widget.Toast;

	public class Fileupload extends Activity {
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
			setContentView(R.layout.activity_fileupload);
			
			Lat=getIntent().getExtras().getString("Lat");
			Log=getIntent().getExtras().getString("Log");
			
			w1=(WebView)findViewById(R.id.webViewmap);
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

				
		    	w1.loadUrl("http://192.168.43.42/ImageMap/Fileupd.php?Lat="+Lat+"&Log="+Log);
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
	          Fileupload.this.startActivityForResult(Intent.createChooser(i,"File Chooser"), FILECHOOSER_RESULTCODE);  

	         }

	      // For Android 3.0+
	         public void openFileChooser( ValueCallback uploadMsg, String acceptType ) {
	         mUploadMessage = uploadMsg;
	         Intent i = new Intent(Intent.ACTION_GET_CONTENT);
	         i.addCategory(Intent.CATEGORY_OPENABLE);
	         i.setType("*/*");
	         Fileupload.this.startActivityForResult(
	         Intent.createChooser(i, "File Browser"),
	         FILECHOOSER_RESULTCODE);
	         }

	      //For Android 4.1
	         public void openFileChooser(ValueCallback<Uri> uploadMsg, String acceptType, String capture){
	             mUploadMessage = uploadMsg;  
	             Intent i = new Intent(Intent.ACTION_GET_CONTENT);  
	             i.addCategory(Intent.CATEGORY_OPENABLE);  
	             i.setType("image/*");  
	             Fileupload.this.startActivityForResult( Intent.createChooser( i, "File Chooser" ), Fileupload.FILECHOOSER_RESULTCODE );

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
	        	Fileupload.this.setTitle(title);
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
	    
	    private void takeScreenshot() {
	        Date now = new Date();
	        android.text.format.DateFormat.format("yyyy-MM-dd_hh:mm:ss", now);

	        try {
	            // image naming and path  to include sd card  appending name you choose for file
	            String mPath = Environment.getExternalStorageDirectory().toString() + "/" + now + ".jpg";

	            // create bitmap screen capture
	            View v1 = getWindow().getDecorView().getRootView();
	            v1.setDrawingCacheEnabled(true);
	            Bitmap bitmap = Bitmap.createBitmap(v1.getDrawingCache());
	            v1.setDrawingCacheEnabled(false);

	            File imageFile = new File(mPath);

	            FileOutputStream outputStream = new FileOutputStream(imageFile);
	            int quality = 100;
	            bitmap.compress(Bitmap.CompressFormat.JPEG, quality, outputStream);
	            outputStream.flush();
	            outputStream.close();

	            openScreenshot(imageFile);
	        } catch (Throwable e) {
	            // Several error may come out with file handling or OOM
	            e.printStackTrace();
	        }
	    }
	        
	    private void openScreenshot(File imageFile) {
	        Intent intent = new Intent();
	        intent.setAction(Intent.ACTION_VIEW);
	        Uri uri = Uri.fromFile(imageFile);
	        intent.setDataAndType(uri, "image/*");
	        startActivity(intent);
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

		@Override
		public boolean onOptionsItemSelected(MenuItem item) {
		    // Handle action bar item clicks here. The action bar will
		    // automatically handle clicks on the Home/Up button, so long
		    // as you specify a parent activity in AndroidManifest.xml.
		    int id = item.getItemId();
		    if (id == R.id.action_cpfu) {
			

		    	takeScreenshot();
		    	

		    }
		    return super.onOptionsItemSelected(item);
		}
		
	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.fileupload, menu);
		return true;
	}

		
	}

