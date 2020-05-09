package com.dinusclass.app.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.dinusclass.app.R;
import com.dinusclass.app.model.ModelRoom;
import com.dinusclass.app.util.ServerAPI;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

import static com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions.withCrossFade;

public class AdapterRoom extends RecyclerView.Adapter<AdapterRoom.HolderData> {
    private Context context;
    private List<ModelRoom> mItems;
    private ArrayList<ModelRoom> arrayList;
    private ItemClickListener clickListener;

    public interface ItemClickListener {
        void onClick(View view, int position);
    }

    public AdapterRoom(Context context, List<ModelRoom> items) {
        this.context = context;
        this.mItems = items;
        this.arrayList = new ArrayList<>();
        this.arrayList.addAll(items);
    }

    @NonNull
    @Override
    public HolderData onCreateViewHolder(ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_room,
                parent, false);
        return new HolderData(layout);
    }

    @SuppressLint("SetTextI18n")
    @Override
    public void onBindViewHolder(HolderData holder, int position) {
        ModelRoom mr = mItems.get(position);
        holder.tvCode.setText("Code : " + mr.getCode());
        if (mr.getType().equals("hall")) {
            holder.tvName.setText("Hall : " + mr.getName());
        } else if (mr.getType().equals("class")) {
            holder.tvName.setText("Class : " + mr.getName());
        } else {
            holder.tvName.setText("Lab : " + mr.getName());
        }
        holder.tvCapacity.setText("Capacity : " + mr.getCapacity() + " people");
        Glide.with(context).load(ServerAPI.URL_FILE_ROOM + mr.getImage()).thumbnail(0.5f).transition(withCrossFade()).
                diskCacheStrategy(DiskCacheStrategy.ALL).into(holder.ivImage);
        holder.mr = mr;
    }

    @Override
    public int getItemCount() {
        return mItems.size();
    }

    class HolderData extends RecyclerView.ViewHolder implements View.OnClickListener {
        TextView tvCode, tvName, tvCapacity;
        ImageView ivImage;
        ModelRoom mr;

        HolderData(View view) {
            super(view);
            tvCode = view.findViewById(R.id.tv_code);
            tvName = view.findViewById(R.id.tv_name);
            tvCapacity = view.findViewById(R.id.tv_capacity);
            ivImage = view.findViewById(R.id.iv_image);
            view.setTag(view);
            view.setOnClickListener(this);
        }

        @Override
        public void onClick(View view) {
            if (clickListener != null)
                clickListener.onClick(view, getAdapterPosition());
        }
    }

    public void setClickListener(ItemClickListener clickListener) {
        this.clickListener = clickListener;
    }

    public void filter(String charText) {
        charText = charText.toLowerCase(Locale.getDefault());
        mItems.clear();
        if (charText.length() == 0) {
            mItems.addAll(arrayList);
        } else {
            for (ModelRoom wp : arrayList) {
                if (wp.getName().toLowerCase(Locale.getDefault()).contains(charText)) {
                    mItems.add(wp);
                }
            }
        }
        notifyDataSetChanged();
    }
}
