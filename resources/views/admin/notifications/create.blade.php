@extends('layouts.admin')

@section('title', 'Soạn Thông Báo')

@section('content')
<div class="container my-5">
    <h2>Soạn Thông Báo</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form id="notification-form" action="{{ route('admin.notification.send') }}" method="POST">
        @csrf
        {{-- Bước 1: Chọn loại đối tượng --}}
        <div class="mb-4">
            <label for="recipient_type" class="form-label">Chọn Loại Đối Tượng</label>
            <select id="recipient_type" name="recipient_type" class="form-select" required onchange="updateRecipientOptions()">
                <option value="">Chọn loại đối tượng</option>
                <option value="teacher">Giáo Viên</option>
                <option value="parent">Phụ Huynh</option>
            </select>
        </div>

        {{-- Bước 2: Chọn đối tượng cụ thể --}}
        <div id="recipient-options" class="mb-4" style="display: none;">
            <label for="recipient_selection" class="form-label">Chọn Đối Tượng</label>
            <select id="recipient_selection" name="recipient_selection" class="form-select" required>
                <option value="">Chọn đối tượng</option>
                <option value="single">1 Người</option>
                <option value="multiple">Nhiều Người</option>
                <option value="all">Tất Cả</option>
            </select>
        </div>

        {{-- Bước 3: Hiển thị danh sách cụ thể --}}
        <div id="specific-recipients" class="mb-4" style="display: none;">
            <label for="recipients" class="form-label">Chọn Người Nhận</label>
            <select id="recipients" name="recipients[]" class="form-select" multiple>
                {{-- Các giá trị sẽ được điền tự động qua JavaScript --}}
            </select>
        </div>

        {{-- Nội dung thông báo --}}
        <div class="mb-4">
            <label for="message" class="form-label">Nội Dung Thông Báo</label>
            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Gửi Thông Báo</button>
    </form>
</div>

<script>
    const teachers = @json($teachers);
    const parents = @json($parents);

    function updateRecipientOptions() {
     const recipientType = document.getElementById('recipient_type').value;
     const recipientSelection = document.getElementById('recipient_selection');
     const specificRecipients = document.getElementById('specific-recipients');
     const recipientsDropdown = document.getElementById('recipients');

     recipientSelection.value = '';
     recipientsDropdown.innerHTML = '';
     specificRecipients.style.display = 'none';

     if (recipientType) {
         document.getElementById('recipient-options').style.display = 'block';
     } else {
         document.getElementById('recipient-options').style.display = 'none';
     }
 }

// Đặt sự kiện này ra ngoài
document.getElementById('recipient_selection').addEventListener('change', function() {
     const selection = this.value;
     const recipientType = document.getElementById('recipient_type').value;
     const specificRecipients = document.getElementById('specific-recipients');
     const recipientsDropdown = document.getElementById('recipients');

     recipientsDropdown.innerHTML = '';

     if (selection === 'single' || selection === 'multiple') {
         specificRecipients.style.display = 'block';

         const options = recipientType === 'teacher' ? teachers : parents;
         options.forEach(option => {
             const opt = document.createElement('option');
             opt.value = option.id;
             opt.textContent = option.name;
             recipientsDropdown.appendChild(opt);
         });
     } else {
         specificRecipients.style.display = 'none';
     }
 });

</script>
@endsection
