package com.dinusclass.app.adapter;

import android.annotation.SuppressLint;
import android.content.Context;
import android.graphics.Color;
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
import com.dinusclass.app.model.ModelNotifications;
import com.dinusclass.app.util.ServerAPI;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.List;
import java.util.Objects;

import static com.bumptech.glide.load.resource.drawable.DrawableTransitionOptions.withCrossFade;

public class AdapterNotifications extends RecyclerView.Adapter<AdapterNotifications.HolderData> {
    private Context context;
    private List<ModelNotifications> mItems;
    private ItemClickListener clickListener;

    public interface ItemClickListener {
        void onClick(View view, int position);
    }

    public AdapterNotifications(Context context, List<ModelNotifications> items) {
        this.context = context;
        this.mItems = items;
    }

    @NonNull
    @Override
    public HolderData onCreateViewHolder(ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.item_notifications,
                parent, false);
        return new HolderData(layout);
    }

    @SuppressLint("SetTextI18n")
    @Override
    public void onBindViewHolder(@NonNull HolderData holder, int position) {
        ModelNotifications mn = mItems.get(position);
        @SuppressLint("SimpleDateFormat") DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        @SuppressLint("SimpleDateFormat") DateFormat dateFormat2 = new SimpleDateFormat("HH.mm");
        Date date = new Date();
        try {
            if(Objects.requireNonNull(dateFormat.parse(mn.getDate())).after(dateFormat.parse(dateFormat.format(date)))
                    || Objects.requireNonNull(dateFormat.parse(mn.getDate())).equals(dateFormat.parse(dateFormat.format(date)))
                    && Objects.requireNonNull(dateFormat2.parse(mn.getTime().substring(6))).after(dateFormat2.parse(dateFormat2.format(date)))) {
                holder.tvStatus.setText("Active");
                holder.tvStatus.setTextColor(Color.GREEN);
            } else {
                holder.tvStatus.setText("Finish");
                holder.tvStatus.setTextColor(Color.BLACK);
            }
        } catch (ParseException e) {
            e.printStackTrace();
        }
        holder.tvType.setText(mn.getType().substring(0, 1).toUpperCase() + mn.getType().substring(1));
        holder.tvName.setText(mn.getName());
        holder.tvDate.setText(mn.getDate());
        holder.tvTime.setText(mn.getTime());
        Glide.with(context).load(ServerAPI.URL_FILE_ROOM + mn.getImage()).thumbnail(0.5f).transition(withCrossFade()).
                diskCacheStrategy(DiskCacheStrategy.ALL).into(holder.ivImage);
        holder.mn = mn;
    }

    @Override
    public int getItemCount() {
        return mItems.size();
    }

    class HolderData extends RecyclerView.ViewHolder implements View.OnClickListener {
        TextView tvStatus, tvType, tvName, tvDate, tvTime;
        ImageView ivImage;
        ModelNotifications mn;

        HolderData(View view) {
            super(view);
            tvStatus = view.findViewById(R.id.tv_status);
            tvType = view.findViewById(R.id.tv_type);
            tvName = view.findViewById(R.id.tv_name);
            tvDate = view.findViewById(R.id.tv_date);
            tvTime = view.findViewById(R.id.tv_time);
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
}
