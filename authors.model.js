const mongoose = require('mongoose');

const AuthorsSchema = mongoose.Schema(
    {
        name: {
            type: String,
            required: [true, "Name is required!"]
        },
        biography: {
            type: String,
        },
        email: {
            type: String,
            required: [true, "Email is required!"]
        }
    },
    {
        timestamps: true,
    }
);

const Author = mongoose.model("Author", AuthorsSchema);

module.exports = Author;