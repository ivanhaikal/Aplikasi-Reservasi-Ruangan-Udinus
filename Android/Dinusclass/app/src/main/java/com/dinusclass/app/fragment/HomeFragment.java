package com.dinusclass.app.fragment;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

import com.dinusclass.app.R;
import com.dinusclass.app.ui.ListRoom;

import java.util.Objects;

public class HomeFragment extends Fragment {
    private Intent intent;
    private static final String TAG_NAME = "name";
    private static final String my_shared_preferences = "my_shared_preferences";

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        final View root = inflater.inflate(R.layout.fragment_home, container, false);

        TextView tvName;
        LinearLayout llHall, llClass, llLab;

        tvName = root.findViewById(R.id.tv_name);
        llHall = root.findViewById(R.id.ll_hall);
        llClass = root.findViewById(R.id.ll_class);
        llLab = root.findViewById(R.id.ll_lab);

        SharedPreferences sharedpreferences = Objects.requireNonNull(getActivity()).getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
        tvName.setText(sharedpreferences.getString(TAG_NAME, null));

        llHall.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                intent = new Intent(getActivity(), ListRoom.class);
                intent.putExtra("room", "hall");
                startActivity(intent);
            }
        });
        llClass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                intent = new Intent(getActivity(), ListRoom.class);
                intent.putExtra("room", "class");
                startActivity(intent);
            }
        });
        llLab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                intent = new Intent(getActivity(), ListRoom.class);
                intent.putExtra("room", "lab");
                startActivity(intent);
            }
        });
        return root;
    }
}
