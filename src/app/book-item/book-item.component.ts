import { Component, EventEmitter, Input, Output } from '@angular/core';
import { BookModel } from '../../models/book.model';

@Component({
  selector: 'app-book-item',
  templateUrl: './book-item.component.html',
  styleUrls: ['./book-item.component.scss'],
  standalone: false
})
export class BookItemComponent {
  @Input() book!: BookModel;

  @Output() giveId = new EventEmitter<number>();
  @Output() toggleFavorite = new EventEmitter<number>();
  @Output() quickProgress = new EventEmitter<number>();

  getCorrectBase64(screen?: string): string {
    if (!screen) return '';
    if (screen.startsWith('assets/') || screen.startsWith('http://') || screen.startsWith('https://') || screen.startsWith('data:image')) {
      return screen;
    }
    return `data:image/jpeg;base64,${screen}`;
  }

  getCategoryClass(category?: string): string {
    const cat = (category || '').toLowerCase().trim();
    if (cat.includes('thriller') || cat.includes('mystery') || cat.includes('crime') || cat.includes('horror')) {
      return 'bg-rose-500/20 text-rose-300 border-rose-500/40';
    }
    if (cat.includes('psychology') || cat.includes('self-help') || cat.includes('philosophy')) {
      return 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40';
    }
    if (cat.includes('design') || cat.includes('tech') || cat.includes('code')) {
      return 'bg-indigo-500/20 text-indigo-300 border-indigo-500/40';
    }
    if (cat.includes('sci-fi') || cat.includes('fantasy') || cat.includes('space')) {
      return 'bg-cyan-500/20 text-cyan-300 border-cyan-500/40';
    }
    return 'bg-amber-500/20 text-amber-300 border-amber-500/40';
  }

  onCardClick(): void {
    if (this.book?.uid) {
      this.giveId.emit(this.book.uid);
    }
  }

  onFavoriteClick(event: MouseEvent): void {
    event.stopPropagation();
    if (this.book?.uid) {
      this.toggleFavorite.emit(this.book.uid);
    }
  }

  onQuickProgressClick(event: MouseEvent): void {
    event.stopPropagation();
    if (this.book?.uid) {
      this.quickProgress.emit(this.book.uid);
    }
  }
}
