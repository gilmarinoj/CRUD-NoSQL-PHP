const mongoose = require('mongoose')

const CategoriesSchema = mongoose.Schema(
    {
        name: {
            type: String,
            required: [true, "Name is required!"]
        },
        description: {
            type: String,
            required: [true, "Description is required!"]
        },
    },
    {
        timestamps: true,
    }
);

const Category = mongoose.model("Category", CategoriesSchema);

module.exports = Category;