package com.dinusclass.app.ui;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.SearchView;
import android.widget.Toast;

import com.androidnetworking.AndroidNetworking;
import com.androidnetworking.common.Priority;
import com.androidnetworking.error.ANError;
import com.androidnetworking.interfaces.JSONArrayRequestListener;
import com.dinusclass.app.R;
import com.dinusclass.app.adapter.AdapterRoom;
import com.dinusclass.app.model.ModelRoom;
import com.dinusclass.app.util.ServerAPI;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class ListRoom extends AppCompatActivity implements AdapterRoom.ItemClickListener {
    ProgressDialog pd;
    SearchView svSearch;
    RecyclerView rvRoom;
    List<ModelRoom> mItemsRoom;
    AdapterRoom mAdapterRoom;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_list);

        svSearch = findViewById(R.id.sv_search);
        rvRoom = findViewById(R.id.rv_room);
        mItemsRoom = new ArrayList<>();
        AndroidNetworking.initialize(getApplicationContext());
        loadRoom();

        svSearch.setQueryHint("search " + getIntent().getStringExtra("room"));
        svSearch.setOnQueryTextListener(new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String query) {
                return false;
            }

            @Override
            public boolean onQueryTextChange(String newText) {
                mAdapterRoom.filter(newText);
                return false;
            }
        });
    }

    public void loadRoom() {
        pd = new ProgressDialog(this);
        pd.setCancelable(false);
        pd.setMessage("Reading ...");
        pd.show();
        AndroidNetworking.get(ServerAPI.URL_VIEW_ROOM)
                .setPriority(Priority.LOW)
                .build()
                .getAsJSONArray(new JSONArrayRequestListener() {
                    @Override
                    public void onResponse(JSONArray response) {
                        try {
                            for (int i = 0; i < response.length(); i++) {
                                JSONObject data = response.getJSONObject(i);
                                if (data.getString("type").equals(getIntent().getStringExtra("room"))) {
                                    mItemsRoom.add(new ModelRoom(
                                            data.getString("id"),
                                            data.getString("code"),
                                            data.getString("name"),
                                            data.getString("capacity"),
                                            data.getString("image"),
                                            data.getString("type")
                                    ));
                                }
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                        mAdapterRoom = new AdapterRoom(ListRoom.this, mItemsRoom);
                        mAdapterRoom.setClickListener(ListRoom.this);
                        rvRoom.setLayoutManager(new LinearLayoutManager(ListRoom.this));
                        rvRoom.setAdapter(mAdapterRoom);
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
    public void onClick(View view, int position) {
        Intent intent = new Intent(ListRoom.this, PreviewRoom.class);
        intent.putExtra("id", mItemsRoom.get(position).getId());
        intent.putExtra("code", mItemsRoom.get(position).getCode());
        intent.putExtra("name", mItemsRoom.get(position).getName());
        intent.putExtra("capacity", mItemsRoom.get(position).getCapacity());
        intent.putExtra("image", mItemsRoom.get(position).getImage());
        intent.putExtra("type", mItemsRoom.get(position).getType());
        startActivity(intent);
    }
}
