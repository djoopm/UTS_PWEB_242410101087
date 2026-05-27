<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    
    public function showLogin()
    {
        return view('login');
    }

    // Proses login dengan validasi
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:30',
        ], [
            'username.required' => 'Username wajib diisi!',
            'username.min'      => 'Username minimal 3 karakter.',
            'username.max'      => 'Username maksimal 30 karakter.',
        ]);

        $username = $request->input('username');
        return redirect('/dashboard?username=' . urlencode($username));
    }

    public function logout()
    {
        return redirect('/');
    }

    private function getDefaultBooks()
    {
        return [
            ['id' => 1, 'judul' => 'Laskar Pelangi',          'pengarang' => 'Andrea Hirata',         'genre' => 'Novel',        'tahun' => 2005, 'status' => 'Tersedia'],
            ['id' => 2, 'judul' => 'Bumi Manusia',             'pengarang' => 'Pramoedya Ananta Toer', 'genre' => 'Sejarah',      'tahun' => 1980, 'status' => 'Tersedia'],
            ['id' => 3, 'judul' => 'Sapiens',                  'pengarang' => 'Yuval Noah Harari',     'genre' => 'Non-fiksi',    'tahun' => 2011, 'status' => 'Dipinjam'],
            ['id' => 4, 'judul' => 'Atomic Habits',            'pengarang' => 'James Clear',           'genre' => 'Self-help',    'tahun' => 2018, 'status' => 'Tersedia'],
            ['id' => 5, 'judul' => 'Dune',                     'pengarang' => 'Frank Herbert',         'genre' => 'Fiksi Ilmiah', 'tahun' => 1965, 'status' => 'Dipinjam'],
            ['id' => 6, 'judul' => 'Negeri 5 Menara',          'pengarang' => 'Ahmad Fuadi',           'genre' => 'Novel',        'tahun' => 2009, 'status' => 'Tersedia'],
            ['id' => 7, 'judul' => 'The Alchemist',            'pengarang' => 'Paulo Coelho',          'genre' => 'Novel',        'tahun' => 1988, 'status' => 'Tersedia'],
            ['id' => 8, 'judul' => 'Clean Code',               'pengarang' => 'Robert C. Martin',      'genre' => 'Teknologi',    'tahun' => 2008, 'status' => 'Tersedia'],
            ['id' => 9, 'judul' => 'Sejarah Tuhan',            'pengarang' => 'Karen Armstrong',       'genre' => 'Sejarah',      'tahun' => 1993, 'status' => 'Dipinjam'],
            ['id' => 10,'judul' => 'The Pragmatic Programmer', 'pengarang' => 'David Thomas',          'genre' => 'Teknologi',    'tahun' => 1999, 'status' => 'Tersedia'],
            ['id' => 11,'judul' => 'Hujan',                    'pengarang' => 'Tere Liye',             'genre' => 'Novel',        'tahun' => 2016, 'status' => 'Tersedia'],
            ['id' => 12,'judul' => 'Ikigai',                   'pengarang' => 'Héctor García',         'genre' => 'Self-help',    'tahun' => 2016, 'status' => 'Dipinjam'],
        ];
    }

    private function getBooks()
    {
        // Ambil data dari session, jika tidak ada gunakan data default
        if (Session::has('books')) {
            return Session::get('books');
        }
        
        $defaultBooks = $this->getDefaultBooks();
        Session::put('books', $defaultBooks);
        return $defaultBooks;
    }

    // Update buku via AJAX
    public function updateBook(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'judul' => 'required|string|max:100',
            'pengarang' => 'required|string|max:100',
            'genre' => 'required|string|max:50',
            'tahun' => 'required|integer|min:1800|max:' . date('Y'),
            'status' => 'required|in:Tersedia,Dipinjam'
        ]);

        $books = $this->getBooks();
        $updated = false;
        
        foreach ($books as $key => $book) {
            if ($book['id'] == $request->id) {
                $books[$key] = [
                    'id' => $request->id,
                    'judul' => $request->judul,
                    'pengarang' => $request->pengarang,
                    'genre' => $request->genre,
                    'tahun' => $request->tahun,
                    'status' => $request->status
                ];
                $updated = true;
                break;
            }
        }
        
        if ($updated) {
            Session::put('books', $books);
            return response()->json([
                'success' => true,
                'message' => 'Buku berhasil diperbarui',
                'data' => $books[$key]
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Buku tidak ditemukan'
        ], 404);
    }

    // Hapus buku via AJAX (opsional)
    public function deleteBook(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);
        
        $books = $this->getBooks();
        $deleted = false;
        
        foreach ($books as $key => $book) {
            if ($book['id'] == $request->id) {
                unset($books[$key]);
                $deleted = true;
                break;
            }
        }
        
        if ($deleted) {
            // Reset array keys
            $books = array_values($books);
            Session::put('books', $books);
            return response()->json([
                'success' => true,
                'message' => 'Buku berhasil dihapus'
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Buku tidak ditemukan'
        ], 404);
    }

    // Tambah buku baru via AJAX (opsional)
    public function addBook(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'pengarang' => 'required|string|max:100',
            'genre' => 'required|string|max:50',
            'tahun' => 'required|integer|min:1800|max:' . date('Y'),
            'status' => 'required|in:Tersedia,Dipinjam'
        ]);
        
        $books = $this->getBooks();
        
        // Generate ID baru
        $newId = count($books) > 0 ? max(array_column($books, 'id')) + 1 : 1;
        
        $newBook = [
            'id' => $newId,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'genre' => $request->genre,
            'tahun' => $request->tahun,
            'status' => $request->status
        ];
        
        $books[] = $newBook;
        Session::put('books', $books);
        
        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data' => $newBook
        ]);
    }

    public function showDashboard(Request $request)
    {
        $username = $request->query('username', 'Pengunjung');
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

    public function showPengelolaan(Request $request)
    {
        $username = $request->query('username', 'Pengunjung');
        $books    = $this->getBooks();

        return view('pengelolaan', compact('books', 'username'));
    }

    public function showProfile(Request $request)
    {
        $username = $request->query('username', 'Pengunjung');

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