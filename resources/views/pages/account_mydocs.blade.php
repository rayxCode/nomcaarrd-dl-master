@extends('pages.account_main')

@section('styles')
    {{-- specific scripts here --}}
@endsection

@section('layouts')
    <div class="container-fluid d-flex">
        <div class="flex-fill">
            <p class="text-black-50">Bookmarks </p>
        </div>
        <div>
            <form action="{{ route('bookmarks.clearAll', auth()->user()->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link text-decoration-none" style="border: none; background: none;"
                    rel="">Clear
                </button>
            </form>
        </div>
    </div>
    {{-- start table query here  --}}
    <hr class="bg-dark" style="margin-top: -3px">
    <table class="table table-hover table-borderless">

        <thead style="font-size: 15px">
            <tr>
                <th>Title </th>
                <th>Status</th>
                <th>Date</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @if ($count < 1)
                <tr>
                    <caption> <i> You haven't submitted any documents yet.</i> </caption>
                </tr>
            @else
            <caption><i>Current list of submitted books</i></caption>
                @foreach ($documents->where('created_at', 'desc') as $docs)
                    <tr>
                        <td>
                            {{$docs->title}}
                        </td>
                        @if ($docs->status !=0)
                            @if ($docs->status == 1)
                            @else
                            @endif
                        @endif
                        <td>{{ (new DateTime($bookmark->catalogs->publishedDate))->format('Y') }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    {{-- end of table query here --}}
    {{-- footer signature --}}
    <br>
    <hr class="bg-dark">

    @include('includes.footer')
    </div>
    </div>
    </div>
@endsection

@section('script')
@endsection
