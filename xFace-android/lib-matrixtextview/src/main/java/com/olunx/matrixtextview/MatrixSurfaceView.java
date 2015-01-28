package com.olunx.matrixtextview;

import android.content.Context;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.Point;
import android.text.format.DateFormat;
import android.util.AttributeSet;
import android.util.Log;
import android.view.SurfaceHolder;
import android.view.SurfaceHolder.Callback;
import android.view.SurfaceView;

import java.util.Calendar;
import java.util.Random;

/**
 * Created by olunx on 14/12/23.
 */
public class MatrixSurfaceView extends SurfaceView implements Callback, Runnable{

    final private String[] matrixChars = { "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L",
            "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4",
            "5", "6", "7", "8", "9", "@", "$", "&", "%", "(", ")", "*", "%", "!", "#", "ア", "イ", "ウ", "エ",
            "オ", "カ", "キ", "ク", "ケ", "コ", "サ", "シ", "ス", "セ", "ソ", "タ", "チ", "ツ", "テ", "ト",
            "ナ", "ニ", "ヌ", "ネ", "ノ", "ハ", "ヒ", "フ", "ヘ", "ホ"};

    final private boolean[][][] digitMasks = {
            { // 0
                    {false, true , true , false},
                    {true , false, false, true },
                    {true , false, false, true },
                    {true , false, false, true },
                    {true , false, false, true },
                    {true , false, false, true },
                    {false, true , true , false},
            },
            { // 1
                    {false, false, true , false},
                    {false, true , true , false},
                    {true , false, true , false},
                    {false, false, true , false},
                    {false, false, true , false},
                    {false, false, true , false},
                    {false, false, true , false},
            },
            { // 2
                    {false, true , true , false},
                    {true , false, false, true },
                    {true , false, false, true },
                    {false, false, true , false},
                    {false, true , false, false},
                    {true , false, false, false},
                    {true , true , true , true },
            },
            { // 3
                    {false, true , true , false},
                    {true , false, false, true },
                    {false, false, false, true },
                    {false, true , true , false},
                    {false, false, false, true },
                    {true , false, false, true },
                    {false, true , true , false},
            },
            { // 4
                    {true , false, false, true },
                    {true , false, false, true },
                    {true , false, false, true },
                    {true , true , true , true },
                    {false, false, false, true },
                    {false, false, false, true },
                    {false, false, false, true },
            },
            { // 5
                    {true , true , true , true },
                    {true , false, false, false},
                    {true , false, false, false},
                    {true , true , true , true },
                    {false, false, false, true },
                    {false, false, false, true },
                    {true , true , true , false},
            },
            { // 6
                    {false, true , true , true },
                    {true , false, false, false},
                    {true , false, false, false},
                    {true , true , true , false},
                    {true , false, false, true },
                    {true , false, false, true },
                    {false, true , true , false},
            },
            { // 7
                    {true , true , true , true },
                    {false, false, false, true },
                    {false, false, false, true },
                    {false, false, false, true },
                    {false, false, true,  false},
                    {false, false, true,  false},
                    {false, false, true,  false},
            },
            { // 8
                    {false, true , true , false},
                    {true , false, false, true },
                    {true , false, false, true },
                    {false, true , true , false},
                    {true , false, false, true },
                    {true , false, false, true },
                    {false, true , true , false},
            },
            { // 9
                    {false, true , true , false},
                    {true , false, false, true },
                    {true , false, false, true },
                    {false, true , true , true },
                    {false, false, false, true },
                    {true , false, false, true },
                    {false, true , true , false},
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


    private Context mContext = null;
    private DrawTask mDrawTask = null;
    private SurfaceHolder mSurfaceHolder = null;
    private Canvas drawCanvas = null;
    private Thread thread = null;

    public MatrixSurfaceView(Context context, AttributeSet attrs) {
        super(context, attrs);
        Log.d("MatrixSurfaceView", "2");

        mContext = context;
        mSurfaceHolder = getHolder();
        mSurfaceHolder.addCallback(this);
        thread = new Thread(this);
        init();
    }

    @Override
    public void surfaceCreated(SurfaceHolder holder) {
        Log.d("MatrixSurfaceView", "surfacecreated");
        mSurfaceHolder = holder;
        thread.start();
        setUnPaused();
    }

    @Override
    public void surfaceChanged(SurfaceHolder holder, int frmt, int w, int h) {
        Log.d("MatrixSurfaceView", "surfacechanged");
        mSurfaceHolder = holder;
        // needed for when people palm over to close an application
        // otherwise the time display will go blank until
        // time timeInfoReceiver is triggered
        if(mDrawTask!=null && mDrawTask.isPaused()) mDrawTask.drawPause();
    }

    @Override
    public void surfaceDestroyed(SurfaceHolder holder) {
        Log.d("MatrixSurfaceView", "surfacedestory");
        drawCanvas = null;
    }

    public void init() {
        Log.d("MatrixSurfaceView", "init");
//        mContext = context;
//        mSurfaceHolder = surfaceHolder;
//        mPoint = point;

//        charWidth = mPoint.x / numRows;
//        xOffset = (mPoint.x - charWidth * numRows)/2;
        charWidth = getWidth() / numRows;
        xOffset = (getWidth() - charWidth * numRows)/2;

        int i, j;
        for(i = 0; i <=5 ; i++) {
            paints[i] = new Paint();
            paints[i].setColor(Color.rgb(0, i * 32, 0));
            paints[i].setTextSize(charWidth - 1);
            paints[i].setAntiAlias(true);
        }
        paints[6] = new Paint();
        paints[6].setColor(Color.rgb(63, 255, 63));
        paints[6].setTextSize(charWidth - 1);
        paints[6].setAntiAlias(true);
        paints[7] = new Paint();
        paints[7].setColor(Color.rgb(191, 255, 191));
        paints[7].setTextSize(charWidth - 1);
        paints[7].setAntiAlias(true);
        paintTime = new Paint();
        paintTime.setColor(Color.rgb(127, 255, 191));
        paintTime.setAlpha(191);
        paintTime.setStyle(Paint.Style.FILL);
        paintTimePause = new Paint();
        paintTimePause.setColor(Color.WHITE);
        paintTimePause.setStyle(Paint.Style.FILL);

        for(i = 0; i < numRows; i++) {
            for (j = 0; j < numRows; j++) {
                theMatrix[i][j] = matrixChars[random.nextInt(matrixChars.length)];
                theIntensities[i][j]=0;
                timeMask[i][j] = false;
            }
        }
        updateTime();
    }

    public boolean updateTime() {
        Log.d("MatrixSurfaceView", "updatetime");
        int i, j, d;
        Calendar c = Calendar.getInstance();
        int hour;

        if(DateFormat.is24HourFormat(mContext)) {
            hour = c.get(Calendar.HOUR_OF_DAY);
        } else {
            hour = c.get(Calendar.HOUR);
            if(hour == 0) hour = 12;
        }
        int minute = c.get(Calendar.MINUTE);

        if(minute != oldMinute) {
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

    public void setPaused() {
        paused = true;
        this.drawPause();
    }

    public void setUnPaused() {
        Log.d("MatrixSurfaceView", "setunpaused");
        int i, j;
        paused = false;
        for(i = 0; i < numRows; i++) {
            for (j = 0; j < numRows; j++) {
                theIntensities[i][j]=0;
            }
        }
        synchronized(signal) { signal.notify(); }
        thread.interrupt();
    }

    public boolean isPaused() {
        return paused;
    }

    public void drawPause() {
        Log.d("MatrixSurfaceView", "drawpause");
        int i, j;
        updateTime();
        if (mSurfaceHolder != null && (drawCanvas = mSurfaceHolder.lockCanvas()) != null) {
            drawCanvas.drawRGB(0, 0, 0);
            for(i = 2; i < numRows - 2; i++) {
                for(j = 4; j < 12; j++) {
                    if(timeMask[i][j]) {
                        drawCanvas.drawRect(xOffset + i * charWidth - 1, j * charWidth + 2, xOffset + i*charWidth + charWidth - 3, j*charWidth + charWidth,  paintTimePause);
                    }
                }
            }
            mSurfaceHolder.unlockCanvasAndPost(drawCanvas);
        }
    }

    @Override
    public void run() {
        Log.d("MatrixSurfaceView", "draw");
        while(true) {
            while (paused) {
                try {
                    synchronized (signal) {
                        signal.wait();
                    }
                } catch (InterruptedException e) {
                }
            }
            updateTime();
            draw();
        }
    }

    public void draw() {
        Log.d("MatrixSurfaceView", "draw");
        if (mSurfaceHolder != null && (drawCanvas = mSurfaceHolder.lockCanvas()) != null) {
            Random random = new Random();
            drawCanvas.drawRGB(0, 0, 0);

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
                        if(theIntensities[i][j]>0) {
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
            Thread.sleep(30);
        } catch (Exception e) {
            // interrupted, no problem
        }
    }




}
