package com.olunx.digitaltextview;

import android.content.Context;
import android.util.AttributeSet;
import android.widget.TextView;

public class DigitalTextView extends TextView
{

	public DigitalTextView(Context context, AttributeSet attrs, int defStyle)
	{
		super(context, attrs, defStyle);
		init(context);
	}

	public DigitalTextView(Context context, AttributeSet attrs)
	{
		super(context, attrs);
		init(context);
	}

	public DigitalTextView(Context context)
	{
		super(context);
		init(context);
	}

	private void init(Context c)
	{
		setTypeface(Typefaces.get(getContext(), "font/digital.ttf"));
	}

}
