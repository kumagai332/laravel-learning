<!DOCTYPE html>
<html lang="ja">

<head>
    <!-- Choices.jsのCSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    {{-- CSS --}}
    <link rel="stylesheet" href="/css/select.css">

    @include('head')
    <title>グループ編集</title>
</head>

<body>
    @include('admin.header')
    <div class="mt-3 container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.admin-management.index') }}">管理画面トップ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.groups.index') }}">グループ一覧</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a>グループ編集</a></li>
            </ol>
        </nav>
        <div class="border">
            <div class="p-2 bg-secondary text-white">グループ編集</div>

            <form action="{{ route('admin.groups.update', $group) }}" method="post">
                @csrf
                @method('patch')
                <div class="mx-5 px-5">

                    <div class="row m-3">
                        <label class="col-sm-2 col-form-label fw-bold" for="group_name">グループ名
                            <span class="text-danger fw-bold">＊</span>
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="group_name" id="group_name" value="{{ $group->group_name }}" required>
                        </div>
                    </div>

                    <div class="row m-3">
                        <label class="col-sm-2 col-form-label fw-bold">所属コース</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="course[]" id="course" multiple>
                                <option disabled>コースを選んでください</option>
                                @foreach ($courses as $course)
                                <option value="{{ $course->id }}" @if ($group->courses->contains($course->id)) selected @endif>
                                    {{ $course->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row m-3">
                        <label class="col-sm-2 col-form-label fw-bold">所属ユーザー</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="user[]" id="user" multiple>
                                <option disabled>ユーザーを選択してください</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($group->users->contains($user->id)) selected @endif>
                                    {{ $user->username }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row m-3">
                        <label class="col-sm-2 col-form-label fw-bold" for="remarks">備考</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="remarks" id="remarks" rows="5">{{ $group->remarks }}</textarea>
                            <input class="form-contorl btn btn-primary mt-3" type="submit" value="更新">
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    @include('admin.groups.courseSelect')
    @include('admin.groups.userSelect')

    {{-- footer --}}
    @include('footer')
</body>

</html>