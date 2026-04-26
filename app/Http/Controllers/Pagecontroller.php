<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        session()->put('username', $username);
        return redirect('/dashboard');
    }

    // buku
    private function getBooks()
    {
        return [
            ['judul' => 'Laskar Pelangi',          'pengarang' => 'Andrea Hirata',         'genre' => 'Novel',        'tahun' => 2005, 'status' => 'Tersedia'],
            ['judul' => 'Bumi Manusia',             'pengarang' => 'Pramoedya Ananta Toer', 'genre' => 'Sejarah',      'tahun' => 1980, 'status' => 'Tersedia'],
            ['judul' => 'Sapiens',                  'pengarang' => 'Yuval Noah Harari',     'genre' => 'Non-fiksi',    'tahun' => 2011, 'status' => 'Dipinjam'],
            ['judul' => 'Atomic Habits',            'pengarang' => 'James Clear',           'genre' => 'Self-help',    'tahun' => 2018, 'status' => 'Tersedia'],
            ['judul' => 'Dune',                     'pengarang' => 'Frank Herbert',         'genre' => 'Fiksi Ilmiah', 'tahun' => 1965, 'status' => 'Dipinjam'],
            ['judul' => 'Negeri 5 Menara',          'pengarang' => 'Ahmad Fuadi',           'genre' => 'Novel',        'tahun' => 2009, 'status' => 'Tersedia'],
            ['judul' => 'The Alchemist',            'pengarang' => 'Paulo Coelho',          'genre' => 'Novel',        'tahun' => 1988, 'status' => 'Tersedia'],
            ['judul' => 'Clean Code',               'pengarang' => 'Robert C. Martin',      'genre' => 'Teknologi',    'tahun' => 2008, 'status' => 'Tersedia'],
            ['judul' => 'Sejarah Tuhan',            'pengarang' => 'Karen Armstrong',       'genre' => 'Sejarah',      'tahun' => 1993, 'status' => 'Dipinjam'],
            ['judul' => 'The Pragmatic Programmer', 'pengarang' => 'David Thomas',          'genre' => 'Teknologi',    'tahun' => 1999, 'status' => 'Tersedia'],
            ['judul' => 'Hujan',                    'pengarang' => 'Tere Liye',             'genre' => 'Novel',        'tahun' => 2016, 'status' => 'Tersedia'],
            ['judul' => 'Ikigai',                   'pengarang' => 'Héctor García',         'genre' => 'Self-help',    'tahun' => 2016, 'status' => 'Dipinjam'],
        ];
    }

    public function showDashboard()
    {
        $username = session('username', 'Pengunjung');
        $books    = $this->getBooks();

        $stats = [
            'books'        => $books,
            'total_buku'   => count($books),
            'total_genre'  => 5,
            'buku_populer' => 'Laskar Pelangi',
            'anggota'      => 48,
        ];

        return view('dashboard', compact('username', 'stats'));
    }

    public function showPengelolaan()
    {
        $username = session('username', 'Pengunjung');
        $books    = $this->getBooks();

        return view('pengelolaan', compact('books', 'username'));
    }

    public function logout()
    {
        session()->forget('username');
        return redirect('/');
    }

    public function showProfile()
    {
        $username = session('username', 'Pengunjung');

        $profile = [
            'username'      => $username,
            'email'         => strtolower($username) . '@perpus.id',
            'role'          => 'Anggota',
            'bergabung'     => '2024',
            'buku_dipinjam' => 3,
            'buku_selesai'  => 17,
        ];

        return view('profile', compact('profile', 'username'));
    }
}