package com.dinusclass.app.account;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.androidnetworking.AndroidNetworking;
import com.androidnetworking.common.Priority;
import com.androidnetworking.error.ANError;
import com.androidnetworking.interfaces.JSONObjectRequestListener;
import com.dinusclass.app.R;
import com.dinusclass.app.util.ServerAPI;

import org.json.JSONException;
import org.json.JSONObject;

public class ChangePassword extends AppCompatActivity {
    ProgressDialog pd;
    ImageView ivBack;
    EditText etOldPassword, etNewPassword, etConfirmPassword;
    String nim_npp, old_password, new_password, confirm_password;
    TextView tvSave;

    ConnectivityManager conMgr;
    SharedPreferences sharedpreferences;

    private static final String my_shared_preferences = "my_shared_preferences";
    private static final String TAG_NIM_NPP = "nim_npp";
    private static final String TAG_SUCCESS = "success";
    private static final String TAG_MESSAGE = "message";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_change_password);

        conMgr = (ConnectivityManager) getSystemService(Context.CONNECTIVITY_SERVICE);
        ivBack = findViewById(R.id.iv_back);
        etOldPassword = findViewById(R.id.et_old_password);
        etNewPassword = findViewById(R.id.et_new_password);
        etConfirmPassword = findViewById(R.id.et_confirm_password);
        tvSave = findViewById(R.id.tv_save);
        sharedpreferences = getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
        nim_npp = sharedpreferences.getString(TAG_NIM_NPP, null);
        AndroidNetworking.initialize(getApplicationContext());

        if (conMgr.getActiveNetworkInfo() == null || !conMgr.getActiveNetworkInfo().isAvailable() || !conMgr.getActiveNetworkInfo().isConnected()) {
            Toast.makeText(getApplicationContext(), "No Internet Connection", Toast.LENGTH_LONG).show();
        }
        ivBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });
        tvSave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                old_password = etOldPassword.getText().toString();
                new_password = etNewPassword.getText().toString();
                confirm_password = etConfirmPassword.getText().toString();
                if (TextUtils.isEmpty(old_password)) {
                    etOldPassword.setError("Old Password can't be empty");
                }
                if (TextUtils.isEmpty(new_password)) {
                    etNewPassword.setError("New Password can't be empty");
                }
                if (TextUtils.isEmpty(confirm_password)) {
                    etConfirmPassword.setError("Confirm Password can't be empty");
                }
                if (new_password.equals(confirm_password)) {
                    if (!TextUtils.isEmpty(old_password) && !TextUtils.isEmpty(new_password) && !TextUtils.isEmpty(confirm_password)) {
                        if (conMgr.getActiveNetworkInfo() != null && conMgr.getActiveNetworkInfo().isAvailable() && conMgr.getActiveNetworkInfo().isConnected()) {
                            updatePassword();
                        } else {
                            Toast.makeText(getApplicationContext(), "No Internet Connection", Toast.LENGTH_LONG).show();

                        }
                    }
                } else {
                    Toast.makeText(ChangePassword.this, "Confirm password not same", Toast.LENGTH_LONG).show();
                }
            }
        });
    }

    public void updatePassword() {
        pd = new ProgressDialog(this);
        pd.setCancelable(false);
        pd.setMessage("Updating ...");
        pd.show();
        AndroidNetworking.post(ServerAPI.URL_UPDATE_PASSWORD)
                .addBodyParameter("nim_npp", nim_npp)
                .addBodyParameter("old_password", old_password)
                .addBodyParameter("new_password", new_password)
                .setPriority(Priority.MEDIUM)
                .build()
                .getAsJSONObject(new JSONObjectRequestListener() {
                    @Override
                    public void onResponse(JSONObject response) {
                        try {
                            if (response.getInt(TAG_SUCCESS) == 1) {
                                Toast.makeText(getApplicationContext(), response.getString(TAG_MESSAGE), Toast.LENGTH_LONG).show();
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
