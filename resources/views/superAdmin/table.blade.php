<table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
      <tr>
        <td>{{$user['name']}}</td>
        <td>{{$user['email']}}</td>
      </tr>
      @endforeach
    </tbody>

    <form action="{{ route('logout') }}" method="POST"
    @csrf
    <button type="submit">Logout</button>
</form>


  </table>
