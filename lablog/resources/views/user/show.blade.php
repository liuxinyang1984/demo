@extends('layouts.default')

@section('content')
<div class="card">
    <div class="card-header">{{$user['username']}}资料</div>
    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="row"></td>
                    <td scope="row"></td>
                    <td scope="row"></td>
                </tr>
            </tbody>
        </table>
    </div>
    <card-foot class="text-muted"></card-foot>
</div>
@endsection

