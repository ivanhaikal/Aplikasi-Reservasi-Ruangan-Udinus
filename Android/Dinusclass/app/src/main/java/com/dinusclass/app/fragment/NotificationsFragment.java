package com.dinusclass.app.fragment;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.androidnetworking.AndroidNetworking;
import com.androidnetworking.common.Priority;
import com.androidnetworking.error.ANError;
import com.androidnetworking.interfaces.JSONArrayRequestListener;
import com.dinusclass.app.R;
import com.dinusclass.app.adapter.AdapterNotifications;
import com.dinusclass.app.model.ModelNotifications;
import com.dinusclass.app.ui.ProofReservation;
import com.dinusclass.app.util.ServerAPI;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.Objects;

public class NotificationsFragment extends Fragment implements AdapterNotifications.ItemClickListener {
    private ProgressDialog pd;
    private RecyclerView rvNotifications;
    private List<ModelNotifications> mItemsNotifications;
    private AdapterNotifications mAdapterNotifications;

    private SharedPreferences sharedpreferences;
    private static final String my_shared_preferences = "my_shared_preferences";
    private static final String TAG_ID = "id";

    public View onCreateView(@NonNull LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        final View root = inflater.inflate(R.layout.fragment_notifications, container, false);

        rvNotifications = root.findViewById(R.id.rv_notifications);
        mItemsNotifications = new ArrayList<>();
        AndroidNetworking.initialize(Objects.requireNonNull(getContext()));
        sharedpreferences = Objects.requireNonNull(getActivity()).getSharedPreferences(my_shared_preferences, Context.MODE_PRIVATE);
        loadNotifications();
        return root;
    }

    private void loadNotifications() {
        pd = new ProgressDialog(getContext());
        pd.setCancelable(false);
        pd.setMessage("Getting Info ...");
        pd.show();
        AndroidNetworking.get(ServerAPI.URL_VIEW_NOTIFICATIONS)
                .setPriority(Priority.LOW)
                .build()
                .getAsJSONArray(new JSONArrayRequestListener() {
                    @Override
                    public void onResponse(JSONArray response) {
                        try {
                            for (int i = 0; i < response.length(); i++) {
                                JSONObject data = response.getJSONObject(i);
                                if (data.getString("accountId").equals(sharedpreferences.getString(TAG_ID, null))) {
                                    mItemsNotifications.add(new ModelNotifications(
                                            data.getString("id"),
                                            data.getString("roomId"),
                                            data.getString("type"),
                                            data.getString("name"),
                                            data.getString("image"),
                                            data.getString("date"),
                                            data.getString("timeId"),
                                            data.getString("time")
                                    ));
                                }
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        mAdapterNotifications = new AdapterNotifications(getContext(), mItemsNotifications);
                        mAdapterNotifications.setClickListener(NotificationsFragment.this);
                        rvNotifications.setLayoutManager(new LinearLayoutManager(getContext()));
                        rvNotifications.setAdapter(mAdapterNotifications);
                        pd.dismiss();
                    }

                    @Override
                    public void onError(ANError error) {
                        Toast.makeText(getContext(), "Server is busy\nPlease try again", Toast.LENGTH_LONG).show();
                        pd.dismiss();
                    }
                });
    }

    @Override
    public void onClick(View view, int position) {
        Intent intent = new Intent(getActivity(), ProofReservation.class);
        intent.putExtra("roomId", mItemsNotifications.get(position).getRoomId());
        intent.putExtra("date", mItemsNotifications.get(position).getDate());
        intent.putExtra("time", mItemsNotifications.get(position).getTimeId());
        startActivity(intent);
    }
}
