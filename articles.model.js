const mongoose = require('mongoose');

const ArticlesSchema = mongoose.Schema(
    {
        title: {
            type: String,
            required: [true, "Article title is required!"],
        },
        date_publication: {
            type: Date,
            default: Date() 
        },
        content: {
            type: String,
            required: [true, "Article content is required!"]
        },
        author_id: {
            type: mongoose.Types.ObjectId,
            ref: "Author",
            required: [true, "Author is required!"]
        },
        category_id: {
            type: mongoose.Types.ObjectId,
            ref: "Category",
            required: [true, "Category is required!"]
        }
    },
    {
        timestamps: true,
    }
);

const Article = mongoose.model("Article", ArticlesSchema);

module.exports = Article;