import { Component, EventEmitter, Input, Output, OnChanges, SimpleChanges } from '@angular/core';
import { BookModel } from '../../models/book.model';

@Component({
  selector: 'app-book-show',
  templateUrl: './book-show.component.html',
  standalone: false
})
export class BookShowComponent implements OnChanges {
  Math = Math;
  @Input() book!: BookModel;

  @Output() progressUpdated = new EventEmitter<BookModel>();
  @Output() backRequested = new EventEmitter<void>();

  activeTab: 'overview' | 'notes' | 'stats' = 'overview';
  newNoteText = '';
  pagesReadInput = 0;

  ngOnChanges(changes: SimpleChanges): void {
    if (changes['book'] && this.book) {
      this.pagesReadInput = Math.round((this.book.progress / 100) * this.book.pages);
      if (!this.book.notes) {
        this.book.notes = [];
      }
    }
  }

  getCorrectBase64(screen?: string): string {
    if (!screen) return '';
    if (screen.startsWith('assets/') || screen.startsWith('http://') || screen.startsWith('https://') || screen.startsWith('data:image')) {
      return screen;
    }
    return `data:image/jpeg;base64,${screen}`;
  }

  onProgressSliderChange(newVal: number): void {
    if (!this.book) return;
    this.book.progress = Math.min(100, Math.max(0, newVal));
    this.pagesReadInput = Math.round((this.book.progress / 100) * this.book.pages);
    if (this.book.progress >= 100) {
      this.book.lastReadDate = new Date().toISOString().split('T')[0];
    }
    this.progressUpdated.emit(this.book);
  }

  onPagesReadInputChange(pages: number): void {
    if (!this.book || !this.book.pages) return;
    const clampedPages = Math.min(this.book.pages, Math.max(0, pages));
    this.pagesReadInput = clampedPages;
    this.book.progress = Math.round((clampedPages / this.book.pages) * 100);
    if (this.book.progress >= 100) {
      this.book.lastReadDate = new Date().toISOString().split('T')[0];
    }
    this.progressUpdated.emit(this.book);
  }

  quickAddProgress(amount: number): void {
    if (!this.book) return;
    this.onProgressSliderChange(this.book.progress + amount);
  }

  markAsComplete(): void {
    this.onProgressSliderChange(100);
  }

  toggleFavorite(): void {
    if (!this.book) return;
    this.book.isFavorite = !this.book.isFavorite;
    this.progressUpdated.emit(this.book);
  }

  addNote(): void {
    if (!this.newNoteText.trim() || !this.book) return;
    if (!this.book.notes) {
      this.book.notes = [];
    }
    this.book.notes.unshift(this.newNoteText.trim());
    this.newNoteText = '';
    this.progressUpdated.emit(this.book);
  }

  removeNote(index: number): void {
    if (this.book?.notes) {
      this.book.notes.splice(index, 1);
      this.progressUpdated.emit(this.book);
    }
  }

  goBack(): void {
    this.backRequested.emit();
  }
}
