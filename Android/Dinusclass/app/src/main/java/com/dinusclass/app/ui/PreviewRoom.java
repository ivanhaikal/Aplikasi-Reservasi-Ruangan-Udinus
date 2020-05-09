package com.dinusclass.app.ui;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.ImageView;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.androidnetworking.AndroidNetworking;
import com.androidnetworking.common.Priority;
import com.androidnetworking.error.ANError;
import com.androidnetworking.interfaces.JSONArrayRequestListener;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.dinusclass.app.R;
import com.dinusclass.app.util.ServerAPI;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.Calendar;
import java.util.Objects;

import static com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions.withCrossFade;

public class PreviewRoom extends AppCompatActivity {
    ProgressDialog pd;
    SharedPreferences sharedpreferences;
    ImageView ivBack, ivImage;
    TextView tvCode, tvDate, tvStatus;
    Button btnDate, btnCheck, btnBook;
    Spinner spTime;
    String[] time;
    boolean isDate, isStatus;
    String date;
    Toast toast;

    Calendar calendar;
    int year, month, day;

    private static final String my_shared_preferences = "my_shared_preferences";
    public static final String TAG_ID = "id";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_preview_room);

        loadTime();

        ivBack = findViewById(R.id.back);
        ivImage = findViewById(R.id.iv_image);
        tvCode = findViewById(R.id.tv_code);
        btnDate = findViewById(R.id.btn_date);
        tvDate = findViewById(R.id.tv_date);
        calendar = Calendar.getInstance();
        year = calendar.get(Calendar.YEAR);
        month = calendar.get(Calendar.MONTH);
        day = calendar.get(Calendar.DAY_OF_MONTH);
        spTime = findViewById(R.id.sp_time);
        btnCheck = findViewById(R.id.btn_check);
        sharedpreferences = getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
        isDate = false;
        toast = Toast.makeText(getApplicationContext(), null, Toast.LENGTH_SHORT);
        AndroidNetworking.initialize(getApplicationContext());

        ivBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });
        Glide.with(this).load(ServerAPI.URL_FILE_ROOM + getIntent().getStringExtra("image")).thumbnail(0.5f).transition(withCrossFade()).
                diskCacheStrategy(DiskCacheStrategy.ALL).into(ivImage);
        tvCode.setText(getIntent().getStringExtra("code"));
        btnDate.setOnClickListener(new View.OnClickListener() {
            @SuppressWarnings("deprecation")
            @Override
            public void onClick(View v) {
                showDialog(999);
            }
        });
        btnCheck.setOnClickListener(new View.OnClickListener() {
            @SuppressLint("SetTextI18n")
            @Override
            public void onClick(View v) {
                if (!isDate || spTime.getSelectedItem().toString().equals("-")) {
                    toast.setText("Select a date and time first");
                    toast.show();
                } else {
                    final Dialog dialog = new Dialog(PreviewRoom.this);
                    dialog.setContentView(R.layout.dialog_view);
                    dialog.show();
                    isStatus = false;
                    loadStatus();

                    TextView tvCode2, tvType, tvName, tvCapacity;
                    tvCode2 = dialog.findViewById(R.id.tv_code);
                    tvType = dialog.findViewById(R.id.tv_type);
                    tvName = dialog.findViewById(R.id.tv_name);
                    tvCapacity = dialog.findViewById(R.id.tv_capacity);
                    tvStatus = dialog.findViewById(R.id.tv_status);
                    btnBook = dialog.findViewById(R.id.btn_book);

                    tvCode2.setText(getIntent().getStringExtra("code"));
                    if (Objects.equals(getIntent().getStringExtra("type"), "hall")) {
                        tvType.setText("hall");
                    } else if (Objects.equals(getIntent().getStringExtra("type"), "class")) {
                        tvType.setText("class");
                    } else {
                        tvType.setText("lab");
                    }
                    tvName.setText(getIntent().getStringExtra("name"));
                    tvCapacity.setText(getIntent().getStringExtra("capacity"));
                    btnBook.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                            Intent intent = new Intent(PreviewRoom.this, ConfirmationRoom.class);
                            intent.putExtra("id", getIntent().getStringExtra("id"));
                            intent.putExtra("code", getIntent().getStringExtra("code"));
                            intent.putExtra("name", getIntent().getStringExtra("name"));
                            intent.putExtra("capacity", getIntent().getStringExtra("capacity"));
                            intent.putExtra("image", getIntent().getStringExtra("image"));
                            intent.putExtra("type", getIntent().getStringExtra("type"));
                            intent.putExtra("date", date);
                            intent.putExtra("timeId", Integer.toString(spTime.getSelectedItemPosition()));
                            intent.putExtra("time", spTime.getSelectedItem().toString());
                            startActivity(intent);
                        }
                    });
                }
            }
        });
    }

    @SuppressWarnings("deprecation")
    @Override
    protected Dialog onCreateDialog(int id) {
        // TODO Auto-generated method stub
        if (id == 999) {
            return new DatePickerDialog(this, myDateListener, year, month, day);
        }
        return null;
    }

    private DatePickerDialog.OnDateSetListener myDateListener = new DatePickerDialog.OnDateSetListener() {
        @Override
        public void onDateSet(DatePicker arg0, int year, int month, int day) {
            showDate(year, month + 1, day);
        }
    };

    private void showDate(int year, int month, int day) {
        isDate = true;
        tvDate.setText(new StringBuilder().append(day).append("/").append(month).append("/").append(year));
        tvDate.setVisibility(View.VISIBLE);
        if (month < 10) {
            if (day < 10) {
                date = year + "-0" + month + "-0" + day;
            } else {
                date = year + "-0" + month + "-" + day;
            }
        } else {
            if (day < 10) {
                date = year + "-" + month + "-0" + day;
            } else {
                date = year + "-" + month + "-" + day;
            }
        }
    }

    public void loadTime() {
        pd = new ProgressDialog(this);
        pd.setCancelable(false);
        pd.setMessage("Reading ...");
        pd.show();
        AndroidNetworking.get(ServerAPI.URL_VIEW_TIME)
                .setPriority(Priority.LOW)
                .build()
                .getAsJSONArray(new JSONArrayRequestListener() {
                    @Override
                    public void onResponse(JSONArray response) {
                        time = new String[response.length() + 1];
                        time[0] = "-";
                        try {
                            for (int i = 0; i < response.length(); i++) {
                                JSONObject data = response.getJSONObject(i);
                                time[i + 1] = data.getString("time");
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        ArrayAdapter<String> adapterTime = new ArrayAdapter<>(PreviewRoom.this,
                                R.layout.custom_spinner_text,
                                time);
                        adapterTime.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
                        spTime.setAdapter(adapterTime);
                        pd.dismiss();
                    }

                    @Override
                    public void onError(ANError error) {
                        Toast.makeText(getApplicationContext(), "Server is busy\nPlease try again", Toast.LENGTH_LONG).show();
                        pd.dismiss();
                    }
                });
    }

    public void loadStatus() {
        AndroidNetworking.get(ServerAPI.URL_VIEW_RESERVATION)
                .setPriority(Priority.LOW)
                .build()
                .getAsJSONArray(new JSONArrayRequestListener() {
                    @SuppressLint("SetTextI18n")
                    @Override
                    public void onResponse(JSONArray response) {
                        try {
                            for (int i = 0; i < response.length(); i++) {
                                JSONObject data = response.getJSONObject(i);
                                if (data.getString("accountId").equals(sharedpreferences.getString(TAG_ID, null))
                                        && data.getString("roomId").equals(getIntent().getStringExtra("id"))
                                        && data.getString("date").equals(date)
                                        && data.getString("time").equals(Integer.toString(spTime.getSelectedItemPosition()))) {
                                    isStatus = true;
                                }
                            }
                            if (!isStatus) {
                                tvStatus.setText("empty");
                                tvStatus.setTextColor(Color.GREEN);
                                btnBook.setEnabled(true);
                                btnBook.setBackgroundResource(R.drawable.custom_button2);
                            } else {
                                tvStatus.setText("booked");
                                tvStatus.setTextColor(Color.RED);
                                btnBook.setEnabled(false);
                                btnBook.setBackgroundResource(R.drawable.custom_button3);
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }

                    @Override
                    public void onError(ANError error) {
                        Toast.makeText(getApplicationContext(), "Server is busy\nPlease try again", Toast.LENGTH_LONG).show();
                        pd.dismiss();
                    }
                });
    }
}
