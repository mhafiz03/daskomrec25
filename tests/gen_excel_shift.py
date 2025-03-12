import pandas as pd
from datetime import datetime, timedelta

num_entries = 20
shift_data = []
base_date = datetime.today().replace(hour=0, minute=0, second=0, microsecond=0)

# Basis waktu untuk shift pertama pada setiap hari (08:30)
base_time = datetime.strptime("08:30", "%H:%M")

# Durasi shift = 1.5 jam, gap antar shift = 0.5 jam (total offset 2 jam)
shift_duration = timedelta(hours=1, minutes=30)
gap_duration = timedelta(minutes=30)

for i in range(num_entries):
    # Setiap 4 data merupakan satu hari
    day_offset = i // 4
    # shift_no berulang dari 1 hingga 4
    shift_no = (i % 4) + 1

    # Tanggal untuk shift ini
    date = (base_date + timedelta(days=day_offset)).strftime("%Y-%m-%d")
    
    # Hitung waktu mulai: shift 1 dimulai tepat 08:30; shift berikutnya dimulai 2 jam setelah shift sebelumnya dimulai
    shift_start_time = base_time + timedelta(hours=2 * (shift_no - 1))
    shift_end_time = shift_start_time + shift_duration

    # Format waktu dalam HH:MM
    time_start = shift_start_time.strftime("%H:%M")
    time_end = shift_end_time.strftime("%H:%M")
    
    # Misal kuota dapat dibuat konstan atau bertambah secara sederhana (di sini gunakan nilai tetap misal 10)
    kuota = 10

    # id berurutan
    record_id = i + 1

    shift_data.append([record_id, shift_no, date, time_start, time_end, kuota])

# Buat DataFrame dan simpan ke file Excel
df = pd.DataFrame(shift_data, columns=["id", "shift_no", "date", "time_start", "time_end", "kuota"])
file_path = "test_shifts.xlsx"
df.to_excel(file_path, index=False)

print(f"File Excel '{file_path}' telah berhasil dibuat.")
