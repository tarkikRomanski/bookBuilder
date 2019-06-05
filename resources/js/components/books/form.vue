<template>
    <b-col>
        <b-card>
            <b-container>
                <b-row>
                    <b-col sm="12" class="mb-2">
                        <b-form-input v-model="book.title" size="lg"></b-form-input>
                    </b-col>
                    <b-col sm="12" md="4">
                        <b-card>
                            <b-button class="w-100" @click="addChapter()"><i class="fa fa-plus"></i> Add Chapter</b-button>
                            <hr>
                            <b-form-input class="mb-2"
                                          v-for="(chapter, index) of book.chapters"
                                          v-model="chapter.name"
                                          :key="index"
                                          @click="selectChapter(index)" />
                        </b-card>
                    </b-col>
                    <b-col sm="12" md="8">
                        <markdown-editor v-if="book.chapters[selectedChapterId]"
                                         v-model="book.chapters[selectedChapterId].content"
                                         ref="markdownEditor" />
                    </b-col>
                </b-row>
            </b-container>
        </b-card>
    </b-col>
</template>

<script>
    export default {
        data() {
            return {
                book: {
                    title: 'New book title',
                    chapters: [
                        {
                            name: 'Chapter 1',
                            content: '### h1',
                        },
                    ],
                },
                selectedChapterId: null,
            }
        },

        methods: {
            addChapter() {
                this.book.chapters.push({
                    name: 'New chapter',
                    content: '',
                });
            },

            selectChapter(id) {
                this.selectedChapterId = id;
            }
        }
    }
</script>

