import { Component, EventEmitter, Output, HostListener, ViewChild, ElementRef } from '@angular/core';
import { BookModel } from '../../models/book.model';

@Component({
  selector: 'app-book-list',
  templateUrl: './book-list.component.html',
  standalone: false
})
export class BookListComponent {
  @Output() showBook = new EventEmitter<BookModel>();
  @ViewChild('searchInput') searchInputRef?: ElementRef<HTMLInputElement>;

  searchQuery = '';
  activeTab: 'all' | 'reading' | 'completed' | 'favorites' = 'all';
  sortBy: 'progress' | 'title' | 'pages' = 'progress';

  showAddModal = false;

  @HostListener('window:keydown', ['$event'])
  handleKeyboardEvent(event: KeyboardEvent): void {
    if (event.key === 'Escape' && this.showAddModal) {
      this.closeAddBookModal();
      return;
    }
    if (event.key === '/' && !this.showAddModal) {
      const activeEl = document.activeElement;
      const isInput = activeEl instanceof HTMLInputElement || activeEl instanceof HTMLTextAreaElement;
      if (!isInput) {
        event.preventDefault();
        const searchEl = document.querySelector<HTMLInputElement>('input[aria-label="Search title or author"]');
        searchEl?.focus();
      }
    }
  }

  // New book form fields
  newTitle = '';
  newAuthor = '';
  newDescription = '';
  newPages: number | null = null;
  newCategory = 'General';

  books: BookModel[] = [
    {
      uid: 1,
      title: 'Unspeakable Things',
      author: 'Jess Lourey',
      description: `Cassie McDowell’s life in 1980s Minnesota seems wholesome. But as local children begin to go missing, dark secrets come to light.`,
      pages: 310,
      progress: 65,
      category: 'Thriller',
      isFavorite: true,
      rating: 4.8,
      lastReadDate: '2026-07-20',
      notes: [
        'Great foreshadowing in chapter 3 regarding the farm house.',
        'Character development of Cassie is top notch.'
      ],
      screen: 'assets/covers/unspeakable_things.jpg',
    },
    {
      uid: 2,
      title: 'Atomic Habits',
      author: 'James Clear',
      description: 'An easy & proven way to build good habits & break bad ones with actionable daily systems.',
      pages: 320,
      progress: 100,
      category: 'Psychology',
      isFavorite: true,
      rating: 4.9,
      lastReadDate: '2026-07-15',
      notes: [
        'Focus on systems, not goals.',
        '1% better every day leads to 37x growth over a year.'
      ],
      screen: 'assets/covers/atomic_habits.jpg',
    },
    {
      uid: 3,
      title: 'Design Systems & UI Patterns',
      author: 'Brad Frost',
      description: 'Master modular component design, design tokens, accessibility, and modern front-end design architecture.',
      pages: 240,
      progress: 35,
      category: 'Design',
      isFavorite: false,
      rating: 4.6,
      lastReadDate: '2026-07-21',
      notes: [
        'Atomic design hierarchy: Atoms, Molecules, Organisms, Templates, Pages.'
      ],
      screen: 'assets/covers/design_systems.jpg',
    },
    {
      uid: 4,
      title: 'Project Hail Mary',
      author: 'Andy Weir',
      description: 'A lone astronaut must save the Earth from an extinction-level catastrophe in this thrilling interstellar journey.',
      pages: 496,
      progress: 0,
      category: 'Sci-Fi',
      isFavorite: false,
      rating: 4.9,
      lastReadDate: '',
      notes: [],
      screen: 'assets/covers/project_hail_mary.jpg',
    }
  ];

  getCorrectBase64(screen?: string): string {
    if (!screen) return '';
    if (screen.startsWith('assets/') || screen.startsWith('http://') || screen.startsWith('https://') || screen.startsWith('data:image')) {
      return screen;
    }
    return `data:image/jpeg;base64,${screen}`;
  }

  get filteredBooks(): BookModel[] {
    let result = this.books.filter(b => {
      const q = this.searchQuery.toLowerCase().trim();
      const matchesSearch = !q || b.title.toLowerCase().includes(q) || b.author.toLowerCase().includes(q);

      if (!matchesSearch) return false;

      if (this.activeTab === 'reading') {
        return b.progress > 0 && b.progress < 100;
      }
      if (this.activeTab === 'completed') {
        return b.progress >= 100;
      }
      if (this.activeTab === 'favorites') {
        return !!b.isFavorite;
      }
      return true;
    });

    result.sort((a, b) => {
      if (this.sortBy === 'title') {
        return a.title.localeCompare(b.title);
      }
      if (this.sortBy === 'pages') {
        return b.pages - a.pages;
      }
      return b.progress - a.progress;
    });

    return result;
  }

  // Bento Stats getters
  get totalBooks(): number {
    return this.books.length;
  }

  get completedBooksCount(): number {
    return this.books.filter(b => b.progress >= 100).length;
  }

  get inProgressBooksCount(): number {
    return this.books.filter(b => b.progress > 0 && b.progress < 100).length;
  }

  get totalPagesRead(): number {
    return Math.round(
      this.books.reduce((acc, b) => acc + (b.pages * (b.progress / 100)), 0)
    );
  }

  get activeReadingBook(): BookModel | undefined {
    return this.books.find(b => b.progress > 0 && b.progress < 100) || this.books[0];
  }

  get averageProgress(): number {
    if (!this.books.length) return 0;
    const sum = this.books.reduce((acc, b) => acc + b.progress, 0);
    return Math.round(sum / this.books.length);
  }

  processBookById(uid: number): void {
    const target = this.books.find(b => b.uid === uid);
    if (target) {
      this.showBook.emit(target);
    }
  }

  onToggleFavorite(uid: number): void {
    const target = this.books.find(b => b.uid === uid);
    if (target) {
      target.isFavorite = !target.isFavorite;
    }
  }

  onQuickIncreaseProgress(uid: number): void {
    const target = this.books.find(b => b.uid === uid);
    if (target) {
      target.progress = Math.min(100, target.progress + 10);
      if (target.progress === 100) {
        target.lastReadDate = new Date().toISOString().split('T')[0];
      }
    }
  }

  openAddBookModal(): void {
    this.showAddModal = true;
  }

  closeAddBookModal(): void {
    this.showAddModal = false;
    this.newTitle = '';
    this.newAuthor = '';
    this.newDescription = '';
    this.newPages = null;
    this.newCategory = 'General';
  }

  saveNewBook(): void {
    if (!this.newTitle || !this.newAuthor) return;

    const newBook: BookModel = {
      uid: Date.now(),
      title: this.newTitle,
      author: this.newAuthor,
      description: this.newDescription || 'No description provided.',
      pages: this.newPages || 200,
      progress: 0,
      category: this.newCategory || 'General',
      isFavorite: false,
      rating: 5.0,
      notes: [],
      screen: 'assets/covers/design_systems.jpg'
    };

    this.books.unshift(newBook);
    this.closeAddBookModal();
  }
}
