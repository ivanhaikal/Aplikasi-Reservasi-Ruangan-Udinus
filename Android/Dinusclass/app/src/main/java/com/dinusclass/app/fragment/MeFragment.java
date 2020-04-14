package com.dinusclass.app.fragment;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RelativeLayout;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.dinusclass.app.R;
import com.dinusclass.app.account.ChangePassword;
import com.dinusclass.app.account.PreLogin;
import com.dinusclass.app.util.ServerAPI;

import java.util.Objects;

import de.hdodenhof.circleimageview.CircleImageView;

import static com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions.withCrossFade;

public class MeFragment extends Fragment {
    private Intent intent;
    private SharedPreferences sharedpreferences;

    private static final String TAG_IMAGE = "image";
    private static final String TAG_STATUS = "status";
    private static final String TAG_NIM_NPP = "nim_npp";
    private static final String TAG_NAME = "name";
    private static final String TAG_GENDER = "gender";
    private static final String TAG_DOB = "dob";
    private static final String TAG_PHONE = "phone";
    private static final String TAG_EMAIL = "email";
    private static final String my_shared_preferences = "my_shared_preferences";
    private static final String session_status = "session_status";

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        final View root = inflater.inflate(R.layout.fragment_me, container, false);

        CircleImageView civImage;
        TextView tvStatus, tvNimNpp, tvName, tvGender, tvDob, tvPhone, tvEmail;
        RelativeLayout rlChangePassword, rlLogout;

        civImage = root.findViewById(R.id.civ_image);
        tvStatus = root.findViewById(R.id.tv_status);
        tvNimNpp = root.findViewById(R.id.tv_nim_npp);
        tvName = root.findViewById(R.id.tv_name);
        tvGender = root.findViewById(R.id.tv_gender);
        tvDob = root.findViewById(R.id.tv_dob);
        tvPhone = root.findViewById(R.id.tv_phone);
        tvEmail = root.findViewById(R.id.tv_email);
        rlChangePassword = root.findViewById(R.id.rl_change_password);
        rlLogout = root.findViewById(R.id.rl_logout);

        sharedpreferences = Objects.requireNonNull(getActivity()).getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
        Glide.with(Objects.requireNonNull(getContext()))
                .load(ServerAPI.URL_FILE_ACCOUNT + sharedpreferences.getString(TAG_IMAGE, null))
                .thumbnail(0.5f).transition(withCrossFade())
                .diskCacheStrategy(DiskCacheStrategy.ALL).into(civImage);
        tvStatus.setText(sharedpreferences.getString(TAG_STATUS, null));
        tvNimNpp.setText(sharedpreferences.getString(TAG_NIM_NPP, null));
        tvName.setText(sharedpreferences.getString(TAG_NAME, null));
        tvGender.setText(sharedpreferences.getString(TAG_GENDER, null));
        tvDob.setText(sharedpreferences.getString(TAG_DOB, null));
        tvPhone.setText(sharedpreferences.getString(TAG_PHONE, null));
        tvEmail.setText(sharedpreferences.getString(TAG_EMAIL, null));

        rlChangePassword.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                intent = new Intent(getActivity(), ChangePassword.class);
                startActivity(intent);
            }
        });
        rlLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SharedPreferences.Editor editor = sharedpreferences.edit();
                editor.putBoolean(session_status, false);
                editor.putString(TAG_NIM_NPP, null);
                editor.putString(TAG_NAME, null);
                editor.putString(TAG_GENDER, null);
                editor.putString(TAG_DOB, null);
                editor.putString(TAG_PHONE, null);
                editor.putString(TAG_EMAIL, null);
                editor.putString(TAG_STATUS, null);
                editor.apply();

                intent = new Intent(getActivity(), PreLogin.class);
                startActivity(intent);
                Objects.requireNonNull(getActivity()).finish();
            }
        });
        return root;
    }
}
