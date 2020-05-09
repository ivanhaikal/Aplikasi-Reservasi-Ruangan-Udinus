package com.dinusclass.app.ui;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.dinusclass.app.R;

public class SuccessReservation extends AppCompatActivity {
    Button btnProof;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_success_reservation);

        btnProof = findViewById(R.id.btn_proof);

        btnProof.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(SuccessReservation.this, ProofReservation.class);
                intent.putExtra("roomId", getIntent().getStringExtra("roomId"));
                intent.putExtra("date", getIntent().getStringExtra("date"));
                intent.putExtra("time", getIntent().getStringExtra("time"));
                startActivity(intent);
                finish();
            }
        });
    }

    @Override
    public void onBackPressed() {
        Intent intent = new Intent(SuccessReservation.this, MainActivity.class);
        startActivity(intent);
        finish();
    }
}
