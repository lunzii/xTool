package com.olunx.xface;

import android.app.Activity;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.Point;
import android.os.Bundle;
import android.support.wearable.view.WatchViewStub;
import android.text.format.DateFormat;
import android.util.Log;
import android.view.SurfaceHolder;
import android.view.SurfaceView;

import java.util.Calendar;
import java.util.Random;

public class FaceMatrix extends Activity implements SurfaceHolder.Callback {
    final private boolean D = true;
    final private String TAG = "FaceMatrix";
    final private FaceMatrix self = this;

    private int CONFIG_SPEED = 30;
    private int COLOR_BACKGROUND = Color.rgb(0, 0, 0);
    private int COLOR_TIME_DIGITAL = Color.rgb(127, 255, 191);
    private int ALPHA_TIME_DIGITAL = 191;
    private int COLOR_CHAR = Color.rgb(191, 255, 191);
    private int COLOR_CHAR_HIGHLIGHT = Color.rgb(63, 255, 63);
    private int COLOR_CHAR_CHANGE_R = 0;
    private int COLOR_CHAR_CHANGE_G = 32;
    private int COLOR_CHAR_CHANGE_B = 0;

    private final static IntentFilter intentFilter;

    private DrawTask mDrawTask = null;
    private SurfaceHolder mSurfaceHolder = null;
    private Canvas drawCanvas = null;

    static {
        intentFilter = new IntentFilter();
        intentFilter.addAction(Intent.ACTION_TIME_TICK);
        intentFilter.addAction(Intent.ACTION_TIMEZONE_CHANGED);
        intentFilter.addAction(Intent.ACTION_TIME_CHANGED);
    }

    private SurfaceView mSurfaceView;

    public BroadcastReceiver timeInfoReceiver = new BroadcastReceiver() {
        final private String TAG = "timeInfoReceiver";

        @Override
        public void onReceive(Context arg0, Intent intent) {
            if (D) Log.d(TAG, "onReceive");
            if (mDrawTask != null && mDrawTask.isPaused()) mDrawTask.drawPause();
        }
    };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        if (D) Log.d(TAG, "onCreate();");
        super.onCreate(savedInstanceState);

        //change style
        CONFIG_SPEED = 120;
//        COLOR_BACKGROUND = Color.rgb(0, 0, 0);
//        COLOR_TIME_DIGITAL = Color.rgb(255, 255, 255);
//        ALPHA_TIME_DIGITAL = 191;
//        COLOR_CHAR = Color.rgb(255, 50, 0);
//        COLOR_CHAR_HIGHLIGHT = Color.rgb(255, 191, 0);
//        COLOR_CHAR_CHANGE_R = 255;
//        COLOR_CHAR_CHANGE_G = 20;
//        COLOR_CHAR_CHANGE_B = 255;


        setContentView(R.layout.face_matrix);
        final WatchViewStub stub = (WatchViewStub) findViewById(R.id.watch_view_stub);
        stub.setOnLayoutInflatedListener(new WatchViewStub.OnLayoutInflatedListener() {
            @Override
            public void onLayoutInflated(WatchViewStub stub) {
                mSurfaceView = (SurfaceView) stub.findViewById(R.id.surfaceView);
                mSurfaceView.getHolder().addCallback(self);
            }
        });

        mDrawTask = new DrawTask();
        mDrawTask.start();

        timeInfoReceiver.onReceive(this, registerReceiver(null, intentFilter));
        registerReceiver(timeInfoReceiver, intentFilter);
    }

    @Override
    protected void onPause() {
        super.onPause();
        mDrawTask.setPaused();
    }

    @Override
    protected void onResume() {
        super.onResume();
        mDrawTask.setUnPaused();
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        unregisterReceiver(timeInfoReceiver);
    }

    @Override
    public void surfaceCreated(SurfaceHolder holder) {
        if (D) Log.d(TAG, "surfaceCreated");
        mSurfaceHolder = holder;
    }

    @Override
    public void surfaceChanged(SurfaceHolder holder, int frmt, int w, int h) {
        if (D) Log.d(TAG, "surfaceChanged");
        mSurfaceHolder = holder;
        // needed for when people palm over to close an application
        // otherwise the time display will go blank until
        // time timeInfoReceiver is triggered
        if (mDrawTask != null && mDrawTask.isPaused()) mDrawTask.drawPause();
    }

    @Override
    public void surfaceDestroyed(SurfaceHolder holder) {
        if (D) Log.d(TAG, "surfaceDestroyed");
        drawCanvas = null;
    }

    private class DrawTask extends Thread {
        final private String TAG = "DrawTask";

        final private String[] matrixChars = {"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L",
                "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4",
                "5", "6", "7", "8", "9", "@", "$", "&", "%", "(", ")", "*", "%", "!", "#", "α", "β", "γ", "δ",
                "ε", "ζ", "η", "θ", "ι", "κ", "λ", "μ", "ν", "ξ", "ο", "π", "ρ", "σ", "τ", "υ",
                "φ", "χ", "ψ", "ω", "ϝ", "ͷ", "ϛ", "ͱ", "ϻ", "ϙ", "ϟ", "ϡ", "ϸ"};

        final private boolean[][][] digitMasks = {
                { // 0
                        {false, true, true, false},
                        {true, false, false, true},
                        {true, false, false, true},
                        {true, false, false, true},
                        {true, false, false, true},
                        {true, false, false, true},
                        {false, true, true, false},
                },
                { // 1
                        {false, false, true, false},
                        {false, true, true, false},
                        {true, false, true, false},
                        {false, false, true, false},
                        {false, false, true, false},
                        {false, false, true, false},
                        {false, false, true, false},
                },
                { // 2
                        {false, true, true, false},
                        {true, false, false, true},
                        {true, false, false, true},
                        {false, false, true, false},
                        {false, true, false, false},
                        {true, false, false, false},
                        {true, true, true, true},
                },
                { // 3
                        {false, true, true, false},
                        {true, false, false, true},
                        {false, false, false, true},
                        {false, true, true, false},
                        {false, false, false, true},
                        {true, false, false, true},
                        {false, true, true, false},
                },
                { // 4
                        {true, false, false, true},
                        {true, false, false, true},
                        {true, false, false, true},
                        {true, true, true, true},
                        {false, false, false, true},
                        {false, false, false, true},
                        {false, false, false, true},
                },
                { // 5
                        {true, true, true, true},
                        {true, false, false, false},
                        {true, false, false, false},
                        {true, true, true, true},
                        {false, false, false, true},
                        {false, false, false, true},
                        {true, true, true, false},
                },
                { // 6
                        {false, true, true, true},
                        {true, false, false, false},
                        {true, false, false, false},
                        {true, true, true, false},
                        {true, false, false, true},
                        {true, false, false, true},
                        {false, true, true, false},
                },
                { // 7
                        {true, true, true, true},
                        {false, false, false, true},
                        {false, false, false, true},
                        {false, false, false, true},
                        {false, false, true, false},
                        {false, false, true, false},
                        {false, false, true, false},
                },
                { // 8
                        {false, true, true, false},
                        {true, false, false, true},
                        {true, false, false, true},
                        {false, true, true, false},
                        {true, false, false, true},
                        {true, false, false, true},
                        {false, true, true, false},
                },
                { // 9
                        {false, true, true, false},
                        {true, false, false, true},
                        {true, false, false, true},
                        {false, true, true, true},
                        {false, false, false, true},
                        {true, false, false, true},
                        {false, true, true, false},
                },
        };

        private final int numRows = 23;
        int charWidth;
        int xOffset;

        private String[][] theMatrix = new String[numRows][numRows];
        private int[][] theIntensities = new int[numRows][numRows];
        private boolean[][] timeMask = new boolean[numRows][numRows];

        private volatile boolean paused = false;
        private final Object signal = new Object();
        private Random random = new Random();
        private Paint[] paints = new Paint[8];
        private Paint paintTime;
        private Paint paintTimePause;
        int[] timedigits = new int[4];
        int oldMinute = -1;

        public DrawTask() {
            Point size = new Point();
            getWindowManager().getDefaultDisplay().getSize(size);
            charWidth = size.x / numRows;
            xOffset = (size.x - charWidth * numRows) / 2;

            int i, j;
            for (i = 0; i <= 5; i++) {
                paints[i] = new Paint();
                paints[i].setColor(Color.rgb(COLOR_CHAR_CHANGE_R, i * COLOR_CHAR_CHANGE_G, COLOR_CHAR_CHANGE_B));
                paints[i].setTextSize(charWidth - 1);
                paints[i].setAntiAlias(true);
            }
            paints[6] = new Paint();
            paints[6].setColor(COLOR_CHAR_HIGHLIGHT);
            paints[6].setTextSize(charWidth - 1);
            paints[6].setAntiAlias(true);
            paints[7] = new Paint();
            paints[7].setColor(COLOR_CHAR);
            paints[7].setTextSize(charWidth - 1);
            paints[7].setAntiAlias(true);
            paintTime = new Paint();
            paintTime.setColor(COLOR_TIME_DIGITAL);
            paintTime.setAlpha(ALPHA_TIME_DIGITAL);
            paintTime.setStyle(Paint.Style.FILL);
            paintTimePause = new Paint();
            paintTimePause.setColor(Color.WHITE);
            paintTimePause.setStyle(Paint.Style.FILL);

            for (i = 0; i < numRows; i++) {
                for (j = 0; j < numRows; j++) {
                    theMatrix[i][j] = matrixChars[random.nextInt(matrixChars.length)];
                    theIntensities[i][j] = 0;
                    timeMask[i][j] = false;
                }
            }
            updateTime();
        }

        public boolean updateTime() {
            int i, j, d;
            Calendar c = Calendar.getInstance();
            int hour;

            if (DateFormat.is24HourFormat(self)) {
                hour = c.get(Calendar.HOUR_OF_DAY);
            } else {
                hour = c.get(Calendar.HOUR);
                if (hour == 0) hour = 12;
            }
            int minute = c.get(Calendar.MINUTE);

            if (minute != oldMinute) {
                timedigits[0] = hour / 10;
                timedigits[1] = hour % 10;
                timedigits[2] = minute / 10;
                timedigits[3] = minute % 10;

                for (d = 0; d < 4; d++) {
                    for (i = 0; i < 4; i++) {
                        for (j = 0; j < 7; j++) {
                            timeMask[i + 2 + d * 5][j + 4] = digitMasks[timedigits[d]][j][i];
                        }
                    }
                }
                oldMinute = minute;
                return true;
            } else {
                return false;
            }
        }

        public boolean isPaused() {
            return paused;
        }

        public void drawPause() {
            int i, j;
            updateTime();
            if (mSurfaceHolder != null && (drawCanvas = mSurfaceHolder.lockCanvas()) != null) {
                drawCanvas.drawColor(COLOR_BACKGROUND);

                for (i = 2; i < numRows - 2; i++) {
                    for (j = 4; j < 12; j++) {
                        if (timeMask[i][j]) {
                            drawCanvas.drawRect(xOffset + i * charWidth - 1, j * charWidth + 2, xOffset + i * charWidth + charWidth - 3, j * charWidth + charWidth, paintTimePause);
                        }
                    }
                }
                mSurfaceHolder.unlockCanvasAndPost(drawCanvas);
            }
        }

        public void run() {
            while (true) {
                while (paused) {
                    try {
                        synchronized (signal) {
                            signal.wait();
                        }
                    } catch (InterruptedException e) {
                    }
                }
                updateTime();
                if (mSurfaceHolder != null && (drawCanvas = mSurfaceHolder.lockCanvas()) != null) {
                    Random random = new Random();
                    drawCanvas.drawColor(COLOR_BACKGROUND);

                    int i, j;
                    for (i = 0; i < numRows; i++) {
                        for (j = numRows - 1; j > 0; j--) {
                            if (theIntensities[i][j] == 7 || (j < 5 && random.nextInt(24) == 0)) {
                                drawCanvas.drawText(theMatrix[i][j], xOffset + i * charWidth, j * charWidth, paints[7]);
                                if (random.nextInt(2) == 0) {
                                    if (j < numRows - 1) {
                                        theIntensities[i][j + 1] = 7;
                                        theMatrix[i][j + 1] = matrixChars[random.nextInt(matrixChars.length)];
                                    }
                                    theIntensities[i][j] = 6;
                                }
                            } else {
                                if (theIntensities[i][j] > 0) {
                                    drawCanvas.drawText(theMatrix[i][j], xOffset + i * charWidth, j * charWidth, paints[theIntensities[i][j]]);
                                }
                                theIntensities[i][j] += random.nextInt(5) - 3;
                                if (theIntensities[i][j] < 0) theIntensities[i][j] = 0;
                                if (theIntensities[i][j] >= 7) theIntensities[i][j] = 6;
                            }
                            if (timeMask[i][j]) {
                                drawCanvas.drawRect(xOffset + i * charWidth - 1, j * charWidth + 2, xOffset + i * charWidth + charWidth - 3, j * charWidth + charWidth, paintTime);
                            }
                        }
                    }
                    mSurfaceHolder.unlockCanvasAndPost(drawCanvas);
                }
                try {
                    Thread.sleep(CONFIG_SPEED);
                } catch (Exception e) {
                    // interrupted, no problem
                }
            }
        }

        public void setPaused() {
            paused = true;
            this.drawPause();
        }

        public void setUnPaused() {
            int i, j;
            paused = false;
            for (i = 0; i < numRows; i++) {
                for (j = 0; j < numRows; j++) {
                    theIntensities[i][j] = 0;
                }
            }
            synchronized (signal) {
                signal.notify();
            }
            this.interrupt();
        }

    }
}
