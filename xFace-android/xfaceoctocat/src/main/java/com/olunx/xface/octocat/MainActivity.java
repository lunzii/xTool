package com.olunx.xface.octocat;

import android.app.Activity;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.res.TypedArray;
import android.os.Bundle;
import android.os.Handler;
import android.support.wearable.view.WatchViewStub;
import android.util.Log;
import android.view.View;
import android.view.animation.AccelerateInterpolator;
import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;
import android.view.animation.DecelerateInterpolator;
import android.widget.ImageView;
import android.widget.TextView;

import com.olunx.timelytextview.TimelyView;

import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;
import java.util.Random;

public class MainActivity extends Activity {
    private static final String TAG = "FaceTimelySeconds";
    private final static IntentFilter intentFilter;
    static {
        intentFilter = new IntentFilter();
        intentFilter.addAction(Intent.ACTION_TIME_TICK);
        intentFilter.addAction(Intent.ACTION_TIMEZONE_CHANGED);
        intentFilter.addAction(Intent.ACTION_TIME_CHANGED);
    }
    private final static int DURATION = 2000;//in miliseconds
    private final static int DURATION_SECONDS = 300;//in miliseconds

    private Handler mHandler = new Handler();
    private boolean isActive = true;
    private Runnable runner;

    private ImageView imageView;
    private TypedArray imageArray;
    private Random random;

    private TimelyView mTextViewOne;
    private TimelyView mTextViewTwo;
    private TimelyView mTextViewThree;
    private TimelyView mTextViewFour;
    private TimelyView mTextViewFive;
    private TimelyView mTextViewSix;

    private Calendar calendar;

    private int prevHoursOne = -1;
    private int prevHoursTwo = -1;
    private int prevMinOne = -1;
    private int prevMinTwo = -1;
    private int prevSecOne = -1;
    private int prevSecTwo = -1;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main_activity);

        final WatchViewStub stub = (WatchViewStub) findViewById(R.id.watch_view_stub);
        stub.setOnLayoutInflatedListener(new WatchViewStub.OnLayoutInflatedListener() {
            @Override
            public void onLayoutInflated(WatchViewStub stub) {
                setViewStuff();

                imageArray = getResources().obtainTypedArray(R.array.images);
                random = new Random();

                runner = new Runnable() {
                    @Override
                    public void run() {
                        setTimeSeconds();
                    }
                };

                startSecondUpdate();

                timeInfoReceiver.onReceive(MainActivity.this, registerReceiver(null, intentFilter));
                registerReceiver(timeInfoReceiver, intentFilter);
            }
        });

    }

    private void setViewStuff() {
        imageView = (ImageView) findViewById(R.id.imageView);
        mTextViewOne = (TimelyView) findViewById(R.id.textViewTimelyOne);
        mTextViewTwo = (TimelyView) findViewById(R.id.textViewTimelyTwo);
        mTextViewThree = (TimelyView) findViewById(R.id.textViewTimelyThree);
        mTextViewFour = (TimelyView) findViewById(R.id.textViewTimelyFour);
        mTextViewFive = (TimelyView) findViewById(R.id.textViewTimelyFive);
        mTextViewSix = (TimelyView) findViewById(R.id.textViewTimelySix);
    }

    public BroadcastReceiver timeInfoReceiver = new BroadcastReceiver() {
        @Override
        public void onReceive(Context arg0, Intent intent) {
            calendar = Calendar.getInstance();
            try {
                if(calendar.get(Calendar.HOUR_OF_DAY) != Integer.parseInt(prevHoursOne + "" + prevHoursTwo)) {
                    setTimeHour();
                }
                if(calendar.get(Calendar.MINUTE) != Integer.parseInt(prevMinOne + "" + prevMinTwo)) {
                    setTimeMinutes();
                }
            } catch (NumberFormatException e) {
                setTimeHour();
                setTimeMinutes();
            }
        }
    };
    @Override
    protected void onDestroy() {
        super.onDestroy();
        unregisterReceiver(timeInfoReceiver);
    }

    @Override
    protected void onResume() {
        super.onResume();
        uncollapseSeconds();
        isActive = true;
        startSecondUpdate();
    }

    @Override
    protected void onPause() {
        isActive = false;
        mHandler.removeCallbacks(runner);
        if(mTextViewFive != null && mTextViewSix != null) {
            mTextViewFive.setVisibility(View.INVISIBLE);
            mTextViewSix.setVisibility(View.INVISIBLE);
        }
        super.onPause();
    }

    private void uncollapseSeconds(){
        prevSecOne = -1;
        prevSecTwo = -1;
        setTimeSeconds();
    }

    private void startSecondUpdate(){
        if(mTextViewFive != null && mTextViewSix != null) {
            mTextViewFive.setVisibility(View.VISIBLE);
            mTextViewSix.setVisibility(View.VISIBLE);

            new Thread(new Runnable() {
                @Override
                public void run() {
                    while (isActive) {
                        try {
                            Thread.sleep(1000);
                            mHandler.post(runner);
                        } catch (Exception e) {
                            // TODO: handle exception
                        }
                    }
                }
            }).start();
        }
    }

    private void setTimeHour(){
        if (mTextViewOne != null && mTextViewTwo != null) {
            int hour = calendar.get(Calendar.HOUR_OF_DAY);
            if(hour >= 10) {
                List<Integer> digits = digits(hour);
                mTextViewOne.animate(prevHoursOne, digits.get(1)).setDuration(DURATION).start();
                mTextViewTwo.animate(prevHoursTwo, digits.get(0)).setDuration(DURATION).start();
                prevHoursOne = digits.get(1);
                prevHoursTwo = digits.get(0);
            } else {
                mTextViewOne.animate(prevHoursOne, 0).setDuration(DURATION).start();
                mTextViewTwo.animate(prevHoursTwo, hour).setDuration(DURATION).start();
                prevHoursOne = 0;
                prevHoursTwo = hour;
            }
        }
    }
    private void setTimeMinutes(){
        if (mTextViewThree != null && mTextViewFour != null) {
            int minutes = calendar.get(Calendar.MINUTE);
            if(minutes < 10) {
                mTextViewThree.animate(prevMinOne, 0).setDuration(DURATION).start();
                mTextViewFour.animate(prevMinTwo, minutes).setDuration(DURATION).start();
                prevMinOne = 0;
                prevMinTwo = minutes;
            } else {
                List<Integer> digits = digits(minutes);
                mTextViewThree.animate(prevMinOne, digits.get(1)).setDuration(DURATION).start();
                mTextViewFour.animate(prevMinTwo, digits.get(0)).setDuration(DURATION).start();
                prevMinOne = digits.get(1);
                prevMinTwo = digits.get(0);
            }
        }
        setRandomImage();
    }
    private void setTimeSeconds(){
        if (mTextViewFive != null && mTextViewSix != null) {
            int seconds = Calendar.getInstance().get(Calendar.SECOND);
            if(seconds < 10) {
                mTextViewFive.animate(prevSecOne, 0).setDuration(DURATION_SECONDS).start();
                mTextViewSix.animate(prevSecTwo, seconds).setDuration(DURATION_SECONDS).start();
                prevSecOne = 0;
                prevSecTwo = seconds;
            } else {
                List<Integer> digits = digits(seconds);
                mTextViewFive.animate(prevSecOne, digits.get(1)).setDuration(DURATION_SECONDS).start();
                mTextViewSix.animate(prevSecTwo, digits.get(0)).setDuration(DURATION_SECONDS).start();
                prevSecOne = digits.get(1);
                prevSecTwo = digits.get(0);
            }
        }
    }

    private void setRandomImage(){
        Log.d("MainActivity", "setRandomImage");
        if(imageView != null && imageArray != null){
            final int rand = random.nextInt(imageArray.length());

            final Animation fadeIn = new AlphaAnimation(0, 1);
            fadeIn.setInterpolator(new DecelerateInterpolator());
            fadeIn.setDuration(1000);

            Animation fadeOut = new AlphaAnimation(1, 0);
            fadeOut.setInterpolator(new DecelerateInterpolator());
            fadeOut.setDuration(1000);
            fadeOut.setAnimationListener(new Animation.AnimationListener() {
                @Override
                public void onAnimationStart(Animation animation) {

                }

                @Override
                public void onAnimationEnd(Animation animation) {
                    imageView.setImageResource(imageArray.getResourceId(rand, 0));
                    imageView.startAnimation(fadeIn);
                }

                @Override
                public void onAnimationRepeat(Animation animation) {

                }
            });
            imageView.startAnimation(fadeOut);
        }
    }

    /**
     * Split number into digits
     * @param number
     * @return digit array
     */
    private static List<Integer> digits(int number) {
        List<Integer> digits = new ArrayList<Integer>();
        while(number > 0) {
            digits.add(number % 10);
            number /= 10;
        }
        return digits;
    }

}
