<form action="{{ route('admin.settings.store') }}" method="POST">
    @csrf
    <h1>Cấu hình hệ thống (Admin)</h1>
    
    <div>
        <label>Giá POS mặc định:</label>
        <input type="number" name="default_price" value="{{ $settings['default_price'] ?? 1800000 }}">
    </div>

    <div>
        <label>Tỉ lệ hoa hồng (%):</label>
        <input type="number" name="commission_rate" value="{{ $settings['commission_rate'] ?? 15 }}">
    </div>

    <button type="submit">Lưu cấu hình</button>
</form>