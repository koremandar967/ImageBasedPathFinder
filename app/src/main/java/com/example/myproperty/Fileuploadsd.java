package com.example.myproperty;

import java.io.File;
import java.io.FileOutputStream;
import java.util.Date;

import com.example.myproperty.Fileupload.SimpleChromeClient;
import com.example.myproperty.Fileupload.SimpleWebViewClient;

import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.view.KeyEvent;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.webkit.ValueCallback;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.webkit.WebSettings.LayoutAlgorithm;
import android.widget.Toast;

public class Fileuploadsd extends Activity {
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
		setContentView(R.layout.activity_fileuploadsd);
		
		w1=(WebView)findViewById(R.id.webViewmapsd);
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
	    	w1.loadUrl("http://192.168.43.42/ImageMap/SourceToDestination.php");
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
          Fileuploadsd.this.startActivityForResult(Intent.createChooser(i,"File Chooser"), FILECHOOSER_RESULTCODE);  

         }

      // For Android 3.0+
         public void openFileChooser( ValueCallback uploadMsg, String acceptType ) {
         mUploadMessage = uploadMsg;
         Intent i = new Intent(Intent.ACTION_GET_CONTENT);
         i.addCategory(Intent.CATEGORY_OPENABLE);
         i.setType("*/*");
         Fileuploadsd.this.startActivityForResult(
         Intent.createChooser(i, "File Browser"),
         FILECHOOSER_RESULTCODE);
         }

      //For Android 4.1
         public void openFileChooser(ValueCallback<Uri> uploadMsg, String acceptType, String capture){
             mUploadMessage = uploadMsg;  
             Intent i = new Intent(Intent.ACTION_GET_CONTENT);  
             i.addCategory(Intent.CATEGORY_OPENABLE);  
             i.setType("image/*");  
             Fileuploadsd.this.startActivityForResult( Intent.createChooser( i, "File Chooser" ), Fileuploadsd.FILECHOOSER_RESULTCODE );

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
        	Fileuploadsd.this.setTitle(title);
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
	    if (id == R.id.action_cpfusd) {
			
	    	takeScreenshot();
	    	
			//Intent intent=new Intent(getApplicationContext(),MainActivity.class);
			//startActivity(intent);

	    }
	    return super.onOptionsItemSelected(item);
	}
	
@Override
public boolean onCreateOptionsMenu(Menu menu) {
	// Inflate the menu; this adds items to the action bar if it is present.
	getMenuInflater().inflate(R.menu.fileuploadsd, menu);
	return true;
}

}
