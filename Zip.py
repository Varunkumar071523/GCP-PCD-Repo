import os
import shutil

# ==========================================
# CONFIGURATION
# ==========================================

# Folder containing plugin folders
SOURCE_DIR = r"C:\Anant study\AS400 Blogs Test\GCP-PCD-Repo"

# Folder where ZIP files will be created
OUTPUT_DIR = r"C:\Anant study\AS400 Blogs Test\Output"

# ==========================================
# CREATE OUTPUT FOLDER
# ==========================================

os.makedirs(OUTPUT_DIR, exist_ok=True)

# ==========================================
# ZIP EACH FOLDER
# ==========================================

for item in os.listdir(SOURCE_DIR):

    item_path = os.path.join(SOURCE_DIR, item)

    # Process only folders
    if os.path.isdir(item_path):

        zip_file_path = os.path.join(OUTPUT_DIR, item)

        print(f"Creating ZIP for: {item}")

        # Create ZIP
        shutil.make_archive(
            base_name=zip_file_path,
            format='zip',
            root_dir=SOURCE_DIR,
            base_dir=item
        )

print("\nAll folders zipped successfully!")