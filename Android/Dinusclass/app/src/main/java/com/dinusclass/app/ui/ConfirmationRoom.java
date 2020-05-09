package com.dinusclass.app.ui;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.androidnetworking.AndroidNetworking;
import com.androidnetworking.common.Priority;
import com.androidnetworking.error.ANError;
import com.androidnetworking.interfaces.JSONObjectRequestListener;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.dinusclass.app.R;
import com.dinusclass.app.util.ServerAPI;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.Objects;

import static com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions.withCrossFade;

public class ConfirmationRoom extends AppCompatActivity {
    ProgressDialog pd;
    Toolbar toolbar;
    TextView tvCode, tvType, tvRoomName, tvCapacity, tvStatus, tvNimNpp, tvAccountName, tvDate, tvTime;
    ImageView ivImage;
    Button btnBook;

    public static final String TAG_NIM_NPP = "nim_npp";
    public static final String TAG_ID = "id";
    public static final String TAG_NAME = "name";
    public static final String TAG_STATUS = "status";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";
    SharedPreferences sharedpreferences;
    public static final String my_shared_preferences = "my_shared_preferences";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_confirmation_room);

        toolbar = findViewById(R.id.toolbar);
        toolbar.setTitle("Confirmation Reservation");
        setSupportActionBar(toolbar);
        toolbar.setNavigationIcon(R.drawable.ic_arrow_back);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });

        tvCode = findViewById(R.id.tv_code);
        tvType = findViewById(R.id.tv_type);
        tvRoomName = findViewById(R.id.tv_room_name);
        tvCapacity = findViewById(R.id.tv_capacity);
        tvStatus = findViewById(R.id.tv_status);
        tvNimNpp = findViewById(R.id.tv_nim_npp);
        tvAccountName = findViewById(R.id.tv_account_name);
        tvDate = findViewById(R.id.tv_date);
        tvTime = findViewById(R.id.tv_time);
        ivImage = findViewById(R.id.iv_image);
        btnBook = findViewById(R.id.btn_book);
        sharedpreferences = getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
        AndroidNetworking.initialize(getApplicationContext());

        tvCode.setText(getIntent().getStringExtra("code"));
        tvType.setText(Objects.requireNonNull(getIntent().getStringExtra("type")).toUpperCase());
        tvRoomName.setText(getIntent().getStringExtra("name"));
        tvCapacity.setText(getIntent().getStringExtra("capacity"));
        tvStatus.setText(sharedpreferences.getString(TAG_STATUS, null));
        tvNimNpp.setText(sharedpreferences.getString(TAG_NIM_NPP, null));
        tvAccountName.setText(sharedpreferences.getString(TAG_NAME, null));
        tvDate.setText(getIntent().getStringExtra("date"));
        tvTime.setText(getIntent().getStringExtra("time"));
        Glide.with(this).load(ServerAPI.URL_FILE_ROOM + getIntent().getStringExtra("image")).thumbnail(0.5f).transition(withCrossFade()).
                diskCacheStrategy(DiskCacheStrategy.ALL).into(ivImage);
        btnBook.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                book();
            }
        });
    }

    public void book() {
        pd = new ProgressDialog(this);
        pd.setCancelable(false);
        pd.setMessage("Wait ...");
        pd.show();
        AndroidNetworking.post(ServerAPI.URL_CREATE_RESERVATION)
                .addBodyParameter("accountId", sharedpreferences.getString(TAG_ID, null))
                .addBodyParameter("roomId", getIntent().getStringExtra("id"))
                .addBodyParameter("date", getIntent().getStringExtra("date"))
                .addBodyParameter("time", getIntent().getStringExtra("timeId"))
                .setPriority(Priority.MEDIUM)
                .build()
                .getAsJSONObject(new JSONObjectRequestListener() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            if (response.getInt(TAG_SUCCESS) == 1) {
                                Toast.makeText(getApplicationContext(), response.getString(TAG_MESSAGE), Toast.LENGTH_LONG).show();
                                Intent intent = new Intent(ConfirmationRoom.this, SuccessReservation.class);
                                intent.putExtra("roomId", getIntent().getStringExtra("id"));
                                intent.putExtra("date", getIntent().getStringExtra("date"));
                                intent.putExtra("time", getIntent().getStringExtra("timeId"));
                                startActivity(intent);
                                finish();
                            } else {
                                Toast.makeText(getApplicationContext(), response.getString(TAG_MESSAGE), Toast.LENGTH_LONG).show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        pd.dismiss();
                    }

                    @Override
                    public void onError(ANError error) {
                        Toast.makeText(getApplicationContext(), "Server is busy\nPlease try again", Toast.LENGTH_LONG).show();
                        pd.dismiss();
                    }
                });
    }
}
