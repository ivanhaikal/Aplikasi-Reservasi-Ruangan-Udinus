package com.dinusclass.app.account;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.dinusclass.app.R;
import com.dinusclass.app.ui.MainActivity;

public class PreLogin extends AppCompatActivity {
    Button toLogin;
    Intent intent;

    SharedPreferences sharedpreferences;
    Boolean session;
    public static final String my_shared_preferences = "my_shared_preferences";
    public static final String session_status = "session_status";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pre_login);

        sharedpreferences = getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
        session = sharedpreferences.getBoolean(session_status, false);

        if (session) {
            intent = new Intent(PreLogin.this, MainActivity.class);
            startActivity(intent);
            finish();
        }

        toLogin = findViewById(R.id.btn_to_login);

        toLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                intent = new Intent(PreLogin.this, Login.class);
                startActivity(intent);
                finish();
            }
        });
    }
}
