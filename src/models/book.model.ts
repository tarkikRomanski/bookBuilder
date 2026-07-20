export interface BookModel {
  uid: number;
  title: string;
  author: string;
  description: string;
  pages: number;
  progress: number;
  screen?: string;
  category?: string;
  isFavorite?: boolean;
  rating?: number;
  lastReadDate?: string;
  notes?: string[];
}
