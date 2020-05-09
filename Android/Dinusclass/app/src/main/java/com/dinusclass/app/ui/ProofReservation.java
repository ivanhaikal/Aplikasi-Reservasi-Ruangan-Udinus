package com.dinusclass.app.ui;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
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

import static com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions.withCrossFade;

public class ProofReservation extends AppCompatActivity {
    ProgressDialog pd;
    Toolbar toolbar;
    TextView tvId, tvCode, tvType, tvRoomName, tvCapacity, tvStatus, tvNimNpp, tvAccountName, tvDate, tvTime;
    ImageView ivImage;
    Button btnCancel;

    SharedPreferences sharedpreferences;
    public static final String my_shared_preferences = "my_shared_preferences";
    public static final String TAG_ID = "id";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_proof_reservation);

        toolbar = findViewById(R.id.toolbar);
        toolbar.setTitle("Proof Reservation");
        setSupportActionBar(toolbar);
        toolbar.setNavigationIcon(R.drawable.ic_arrow_back);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });

        tvId = findViewById(R.id.tv_id);
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
        btnCancel = findViewById(R.id.btn_cancel);
        sharedpreferences = getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
        AndroidNetworking.initialize(getApplicationContext());
        loadReservation();

        btnCancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AlertDialog.Builder myAlertBuilder = new AlertDialog.Builder(ProofReservation.this);
                myAlertBuilder.setTitle("Alert");
                myAlertBuilder.setMessage("Do you want to cancel this reservation?");
                myAlertBuilder.setPositiveButton("Yes", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        deleteReservation();
                    }
                });
                myAlertBuilder.setNegativeButton("No", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int which) {
                        dialog.cancel();
                    }
                });
                myAlertBuilder.show();
            }
        });
    }

    public void loadReservation() {
        pd = new ProgressDialog(this);
        pd.setCancelable(false);
        pd.setMessage("Load Data ...");
        pd.show();
        AndroidNetworking.post(ServerAPI.URL_LOAD_RESERVATION)
                .addBodyParameter("accountId", sharedpreferences.getString(TAG_ID, null))
                .addBodyParameter("roomId", getIntent().getStringExtra("roomId"))
                .addBodyParameter("date", getIntent().getStringExtra("date"))
                .addBodyParameter("time", getIntent().getStringExtra("time"))
                .setPriority(Priority.MEDIUM)
                .build()
                .getAsJSONObject(new JSONObjectRequestListener() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            if (response.getInt(TAG_SUCCESS) == 1) {
                                tvId.setText(response.getString("id"));
                                tvCode.setText(response.getString("code"));
                                tvType.setText(response.getString("type").toUpperCase());
                                tvRoomName.setText(response.getString("room_name"));
                                tvCapacity.setText(response.getString("capacity"));
                                tvStatus.setText(response.getString("status"));
                                tvNimNpp.setText(response.getString("nim_npp"));
                                tvAccountName.setText(response.getString("account_name"));
                                tvDate.setText(response.getString("date"));
                                tvTime.setText(response.getString("time"));
                                Glide.with(ProofReservation.this)
                                        .load(ServerAPI.URL_FILE_ROOM + response.getString("image"))
                                        .thumbnail(0.5f).transition(withCrossFade()).diskCacheStrategy(DiskCacheStrategy.ALL)
                                        .into(ivImage);
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

    public void deleteReservation() {
        pd = new ProgressDialog(this);
        pd.setCancelable(false);
        pd.setMessage("Processing Your Request ...");
        pd.show();
        AndroidNetworking.post(ServerAPI.URL_DELETE_RESERVATION)
                .addBodyParameter("accountId", sharedpreferences.getString(TAG_ID, null))
                .addBodyParameter("roomId", getIntent().getStringExtra("roomId"))
                .addBodyParameter("date", getIntent().getStringExtra("date"))
                .addBodyParameter("time", getIntent().getStringExtra("time"))
                .setPriority(Priority.MEDIUM)
                .build()
                .getAsJSONObject(new JSONObjectRequestListener() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            if (response.getInt(TAG_SUCCESS) == 1) {
                                Toast.makeText(getApplicationContext(), response.getString(TAG_MESSAGE), Toast.LENGTH_LONG).show();
                                Intent intent = new Intent(ProofReservation.this, MainActivity.class);
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

    @Override
    public void onBackPressed() {
        Intent intent = new Intent(ProofReservation.this, MainActivity.class);
        startActivity(intent);
        finish();
    }
}
