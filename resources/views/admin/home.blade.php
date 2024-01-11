@extends('layouts.admin')
@section('title')
    Admin Anasayfa
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/adminHome.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
@endsection

@section('content')
    <div class="adminPage">
        <div class="container">
            <div class="hero">
                <div class="heroMessage">
                    <h2>Admin Sayfasına Hoşgeldin !</h2>
                    <small>Burada sayfana ait istatiskleri görebilirsin</small>
                </div>
                <div class="statHeroCards">
                    <div class="statHeroCard">
                        <div class="leftSide">
                            <div class="cardTitle">Toplam Tekil Okuma</div>
                            <div class="viewCount">{{ $totalView }} Kişi</div>
                            <a class="moreDetail">Daha Fazla</a>
                        </div>
                        <div class="rightSide">
                            <div class="perChange">
                                {{ round($totalViewRatio,1) }} %
                            </div>
                            <div class="statCardIcon">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="statHeroCard">
                        <div class="leftSide">
                            <div class="cardTitle">Toplam Paylaşılan Blog</div>
                            <div class="viewCount">{{$totalArticle}}</div>
                            <a class="moreDetail">Daha Fazla</a>
                        </div>
                        <div class="rightSide">
                            <div class="perChange">
                                {{ round($ratio, 1) }} %
                            </div>
                            <div class="statCardIcon">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                        </div>
                    </div>
                    <div class="statHeroCard">
                        <div class="leftSide">
                            <div class="cardTitle">Toplam Oluşturulan Kategori</div>
                            <div class="viewCount">{{$totalCategory}}</div>
                            <a class="moreDetail">Daha Fazla</a>
                        </div>
                        <div class="rightSide">
                            <div class="perChange">
                                {{ round($ratioCategory, 1) }} %
                            </div>
                            <div class="statCardIcon">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adminPopularCard">
                    <div class="mostPopularCard">
                        <div class="mostPopularList">
                            <h3>En Çok Okunan Makaleler</h3>
                            <table class="tableContainer">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="thWrapper">
                                                <p>Başlık</p>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="thWrapper">
                                                <p>Ziyaret</p>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="thWrapper">
                                                <p>Yayın Süresi(Gün)</p>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articlesView as $item)
                                        <tr>
                                            <td>{{ substr($item->title, 0, 15) }}</td>
                                            <td>{{ $item->view_count }}</td>
                                            <td>{{ $item->daysDifference }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="goals">
                            <div class="golasHeader">
                                <h3>Hedefler</h3>
                                <div class="createGoalItem"><i class="fa-solid fa-plus"></i></div>
                            </div>
                            @if (isset($goals) && count($goals) > 0)
                                @foreach ($goals as $item)
                                    <div class="progressWrapper progress_{{ $item->id }}">
                                        <p style="width:100%" data-value="{{ round($item->result, 1) }}">
                                            <select disabled name="process_id" id="goalTarget">
                                                <option value="{{ $item->process_id }}"
                                                    {{ isset($item) && $item->id ? 'selected' : '' }}>{{ $item->title }}
                                                </option>
                                                <option value="1">Blog Sayısı</option>
                                                <option value="2">Kategori Sayısı</option>
                                                <option value="3">Toplam Okunma Sayısı</option>
                                            </select>
                                        </p>
                                        <progress max="100" value="{{ round($item->result, 1) }}"
                                            class="jquery"></progress>
                                        <div class="progressFooter">
                                            <small>Hedef:
                                                <input readonly type='text' name="goalNumber" class="progressGoalNumber"
                                                    value="{{ $item->goalNumber }}" id="goalNumber"
                                                    onkeypress="return onlyNumbers(event)"
                                                    onkeyup="return numberValidation(event)">
                                            </small>
                                            <small>{{ $item->daysDifference }} Gündür Yayında</small>
                                            <div class="progressFooterBtns">
                                                <small><a class="articleShowBtn" id="progressUpdate"
                                                        data-id="{{ $item->id }}" href="javascript:void(0)">
                                                        <i class="fa-solid fa-pen"></i></a></small>
                                                <small><a data-id="{{ $item->id }}" href="javascript:void(0)"
                                                        class="btnDelete"><i class="fas fa-trash-can"></i></a></small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>Henüz Hedef Belirlemediniz !</p>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="gallery">
                <h2>Galeri Listesi</h2>
                <div class="itemWrapper">
                    @foreach ($gallery as $item)
                        <a data-caption="{{ $item->title }}" data-fancybox="gallery"
                            data-src="{{ asset($item->image_path) }}">
                            <img class="littleImg" src="{{ asset($item->image_path) }}" />
                        </a>
                    @endforeach

                </div>
            </div>
            <div id="overlay">
                <div id="modal">
                    <form method="POST" action="{{ route('goal.create') }}">
                        @csrf
                        <span id="close">&times;</span>
                        <h3>Hedef Oluştur</h3>
                        <div class="modelItems">
                            <div class="modelItem">
                                <label for="goalTarget">Hedef Seç</label>
                                <select name="process_id" id="goalTarget">
                                    <option value="{{ null }}">Seç</option>
                                    <option value="1">Blog Sayısı</option>
                                    <option value="2">Kategori Sayısı</option>
                                    <option value="3">Toplam Okunma Sayısı</option>
                                </select>
                            </div>
                            <div class="modelItem">
                                <label for="goalNumber">Hedef Sayısı:</label>
                                <input type='text' name="goalNumber" class="numbers" value="" id="goalNumber"
                                    onkeypress="return onlyNumbers(event)" onkeyup="return numberValidation(event)">
                            </div>
                        </div>
                        <button class="modelCreateBtn">Oluştur</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="POST" id="statusChangeForm">
        @csrf
        <input type="hidden" name="id" id="inputStatus" value="">
    </form>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            //
        });
    </script>
    <script>
        function onlyNumbers(e) {
            var c = e.which ? e.which : e.keyCode;
            if (c < 48 || c > 57) {
                return false;
            }
        }

        function numberValidation(e) {
            e.target.value = e.target.value.replace(/[^\d]/g, '');
            return false;
        }
    </script>
    <script>
        $(document).ready(function() {
            // Başlık hücrelerine tıklamayı dinle
            $('.tableContainer th').on('click', function() {
                var index = $(this).index();
                sortTable(index);
            });
            // Sıralama bilgisini tutan değişken
            var sortDirection = {};
            // Tabloyu sıralayan fonksiyon
            function sortTable(columnIndex) {
                var table = $('.tableContainer');
                var rows = $('tbody tr', table).toArray();

                // Sıralama bilgisini kontrol et
                if (sortDirection[columnIndex] === 'asc') {
                    rows.reverse();
                    sortDirection[columnIndex] = 'desc';
                } else {
                    rows.sort(function(a, b) {
                        var cellA = $(a).find('td').eq(columnIndex).text().trim();
                        var cellB = $(b).find('td').eq(columnIndex).text().trim();

                        // Sayısal sıralama
                        if (!isNaN(cellA) && !isNaN(cellB)) {
                            return parseFloat(cellA) - parseFloat(cellB);
                        }
                        // Metinsel sıralama
                        return cellA.localeCompare(cellB);
                    });

                    sortDirection[columnIndex] = 'asc';
                }

                // Sıralı satırları tabloya ekleyin
                var tbody = $('tbody', table);
                tbody.empty();
                $.each(rows, function(index, row) {
                    tbody.append(row);
                });

                // Tüm okları kaldır
                $('.tableContainer th i').remove();

                // Yeni sıralama yönüne göre ok ekleyin
                var th = $('.tableContainer th div').eq(columnIndex);
                if (sortDirection[columnIndex] === 'asc') {
                    th.append('<i class="fa fa-caret-up" aria-hidden="true"></i>');
                } else {
                    th.append('<i class="fa fa-caret-down" aria-hidden="true"></i>');
                }
            }

            $(".createGoalItem").click(function() {
                $("#overlay").fadeIn(300);
                $("#modal").fadeIn(300);
            });

            $("#close").click(function() {
                $("#overlay").fadeOut(300);
                $("#modal").fadeOut(300);
            });

            $('.btnDelete').click(function() {
                let categoryID = $(this).data('id');
                console.log(categoryID);
                $('#inputStatus').val(categoryID);
                Swal.fire({
                    title: "Hedefi Silmek İstediğine Emin misin ?",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Sil",
                    cancelButtonText: "Çıkış"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#statusChangeForm').attr('action', "{{ route('goal.delete') }}");
                        $('#statusChangeForm').submit();
                    }
                });
            });
            $('.progressWrapper').on('click', '#progressUpdate', function() {
                var progressID = $(this).data('id');
                var progressWrapper = $(".progress_" + progressID);
                var inputGoalNumber = progressWrapper.find('.progressGoalNumber');
                var selectItem = progressWrapper.find('#goalTarget');

                var selectedOption = selectItem.find('option:selected');
                if (selectedOption.val()) {
                    selectedOption.text('Seçili: ' + selectedOption.text());
                }


                inputGoalNumber.removeAttr('readonly');
                selectItem.removeAttr('disabled');
                inputGoalNumber.css({
                    'background-color': "white",
                    "border": "1px solid black"
                });
                selectItem.css({
                    "appearance": "auto",
                    'border': "1px solid black"
                });
                var updateBtn = progressWrapper.find('#progressUpdate');
                updateBtn.addClass('progressSave');
                updateBtn.css('color', "orange");
                updateBtn.text('Kaydet').attr('id', 'savePopup');
            });

            $('.progressWrapper').on('click', '.progressSave', function() {
                var progressID = $(this).data('id');
                var progressWrapper = $(".progress_" + progressID);
                var inputGoalNumber = progressWrapper.find('.progressGoalNumber');
                var selectItem = progressWrapper.find('#goalTarget');
                var selectedOption = selectItem.find('option:selected');
                if (selectedOption.val()) {
                    selectedOption.text(selectedOption.text().replace('Seçili: ', ''));
                }
                var selectOptionValue = selectItem.val();
                inputGoalNumber.css({
                    'background-color': "initial",
                    "border": "initial"
                });
                selectItem.css({
                    "appearance": "initial",
                    'border': "initial"
                });
                var newGoalNumer = inputGoalNumber.val();
                if (inputGoalNumber.val().trim() === '') {
                    inputGoalNumber.css("border", "1px solid red");
                    Swal.fire({
                        title: "Hata",
                        text: "Boş Alan Bırakamazsın.",
                        icon: "error",
                    });
                    return false;
                }
                inputGoalNumber.attr('readonly', true);
                selectItem.attr('disabled', true);

                    $.ajax({
                        method: "POST",
                        url: "{{ url('admin/goalupdate') }}/" + progressID,
                        data: {
                            id: progressID,
                            goalNumber: newGoalNumer,
                            process_id: selectOptionValue

                        },
                        success: function(data) {
                            inputGoalNumber.val(newGoalNumer);
                            Swal.fire({
                                title: "Güncelleme Başarılı",
                                confirmButtonText: "Tamam",
                                icon: "success",
                            });
                        },
                        error: function() {
                            Swal.fire({
                                title: "Hata",
                                text: "Güncelleme sırasında bir hata oluştu.",
                                icon: "error",
                            });
                        }
                    });
                var saveBtn = progressWrapper.find('#savePopup');
                saveBtn.html('<i class="fa-solid fa-pen"></i>').attr('id', 'progressUpdate')
                    .removeClass(
                        'progressSave');
                        
            });
        });
    </script>
@endsection
