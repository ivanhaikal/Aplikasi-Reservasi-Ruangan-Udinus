package com.dinusclass.app.account;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.androidnetworking.AndroidNetworking;
import com.androidnetworking.common.Priority;
import com.androidnetworking.error.ANError;
import com.androidnetworking.interfaces.JSONObjectRequestListener;
import com.dinusclass.app.R;
import com.dinusclass.app.ui.MainActivity;
import com.dinusclass.app.util.ServerAPI;
import com.google.android.material.textfield.TextInputEditText;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.Objects;

public class Login extends AppCompatActivity {
    ProgressDialog pd;
    TextInputEditText tietNimNpp, tietPassword;
    String nim_npp, password;
    Button btnLogin;
    Intent intent;

    ConnectivityManager conMgr;
    Toolbar toolbar;

    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";
    public static final String TAG_NIM_NPP = "nim_npp";
    public static final String TAG_NAME = "name";
    public static final String TAG_GENDER = "gender";
    public static final String TAG_DOB = "dob";
    public static final String TAG_PHONE = "phone";
    public static final String TAG_EMAIL = "email";
    public static final String TAG_STATUS = "status";
    public static final String TAG_IMAGE = "image";
    SharedPreferences sharedpreferences;
    public static final String my_shared_preferences = "my_shared_preferences";
    public static final String session_status = "session_status";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        conMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        toolbar = findViewById(R.id.toolbar);
        toolbar.setTitle("Login");
        setSupportActionBar(toolbar);
        toolbar.setNavigationIcon(R.drawable.ic_arrow_back);
        toolbar.setNavigationOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onBackPressed();
            }
        });

        tietNimNpp = findViewById(R.id.tiet_nim_npp);
        tietPassword = findViewById(R.id.tiet_password);
        btnLogin = findViewById(R.id.btn_login);
        AndroidNetworking.initialize(getApplicationContext());

        if (conMgr.getActiveNetworkInfo() == null || !conMgr.getActiveNetworkInfo().isAvailable() || !conMgr.getActiveNetworkInfo().isConnected()) {
            Toast.makeText(getApplicationContext(), "No Internet Connection", Toast.LENGTH_LONG).show();
        }
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                nim_npp = Objects.requireNonNull(tietNimNpp.getText()).toString();
                password = Objects.requireNonNull(tietPassword.getText()).toString();
                if (TextUtils.isEmpty(nim_npp)) {
                    tietNimNpp.setError("Nim/Npp can't be empty");
                }
                if (TextUtils.isEmpty(password)) {
                    tietPassword.setError("Password can't be empty");
                }
                if (!TextUtils.isEmpty(nim_npp) && !TextUtils.isEmpty(password)) {
                    if (conMgr.getActiveNetworkInfo() != null && conMgr.getActiveNetworkInfo().isAvailable() && conMgr.getActiveNetworkInfo().isConnected()) {
                        login();
                    } else {
                        Toast.makeText(getApplicationContext(), "No Internet Connection", Toast.LENGTH_LONG).show();
                    }
                }
            }
        });
    }

    public void login() {
        pd = new ProgressDialog(this);
        pd.setCancelable(false);
        pd.setMessage("Login ...");
        pd.show();
        AndroidNetworking.post(ServerAPI.URL_LOGIN)
                .addBodyParameter("nim_npp", nim_npp)
                .addBodyParameter("password", password)
                .setPriority(Priority.MEDIUM)
                .build()
                .getAsJSONObject(new JSONObjectRequestListener() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            if (response.getInt(TAG_SUCCESS) == 1) {
                                sharedpreferences = getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
                                SharedPreferences.Editor editor = sharedpreferences.edit();
                                editor.putBoolean(session_status, true);
                                editor.putString(TAG_NIM_NPP, nim_npp);
                                editor.putString(TAG_NAME, response.getString(TAG_NAME));
                                editor.putString(TAG_GENDER, response.getString(TAG_GENDER));
                                editor.putString(TAG_DOB, response.getString(TAG_DOB));
                                editor.putString(TAG_PHONE, response.getString(TAG_PHONE));
                                editor.putString(TAG_EMAIL, response.getString(TAG_EMAIL));
                                editor.putString(TAG_STATUS, response.getString(TAG_STATUS));
                                editor.putString(TAG_IMAGE, response.getString(TAG_IMAGE));
                                editor.apply();

                                Toast.makeText(getApplicationContext(), response.getString(TAG_MESSAGE), Toast.LENGTH_LONG).show();
                                intent = new Intent(Login.this, MainActivity.class);
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
        intent = new Intent(Login.this, PreLogin.class);
        startActivity(intent);
        finish();
    }
}
