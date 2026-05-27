import os
import paramiko

# ==========================================
# HOSTINGER CONFIG
# ==========================================

HOST = "217.21.85.96"
PORT = 65002

USERNAME = "u582398747"

PASSWORD = "Anantjohari@1984"

# ==========================================
# LOCAL + REMOTE PATHS
# ==========================================

LOCAL_PLUGIN_FOLDER = r"C:\Anant study\AS400 Blogs Test\Output"

REMOTE_UPLOAD_FOLDER = "/home/u582398747/plugin_uploads"

# ==========================================
# CONNECT SSH
# ==========================================

print("Connecting to Hostinger...")

ssh = paramiko.SSHClient()

ssh.set_missing_host_key_policy(paramiko.AutoAddPolicy())

ssh.connect(
    hostname=HOST,
    port=PORT,
    username=USERNAME,
    password=PASSWORD
)

print("SSH Connected!")

# ==========================================
# OPEN SFTP
# ==========================================

sftp = ssh.open_sftp()

print("Uploading ZIP files...")

# ==========================================
# UPLOAD ZIP FILES
# ==========================================

for file_name in os.listdir(LOCAL_PLUGIN_FOLDER):

    if file_name.endswith(".zip"):

        local_path = os.path.join(LOCAL_PLUGIN_FOLDER, file_name)

        remote_path = f"{REMOTE_UPLOAD_FOLDER}/{file_name}"

        print(f"Uploading: {file_name}")

        sftp.put(local_path, remote_path)

print("All ZIP files uploaded!")

# ==========================================
# INSTALL + ACTIVATE PLUGINS
# ==========================================

print("Installing and activating plugins...")

command = f"""
cd {REMOTE_UPLOAD_FOLDER}

for file in *.zip
do
    echo "Installing $file"

    wp plugin install "$file" --activate --path=/home/{USERNAME}/domains/as400decoded.com/public_html
done
"""

stdin, stdout, stderr = ssh.exec_command(command)

print(stdout.read().decode())

errors = stderr.read().decode()

if errors:
    print("ERRORS:")
    print(errors)

# ==========================================
# OPTIONAL CLEANUP
# ==========================================

cleanup_command = f"""
cd {REMOTE_UPLOAD_FOLDER}
rm -f *.zip
"""

ssh.exec_command(cleanup_command)

# ==========================================
# CLOSE CONNECTIONS
# ==========================================

sftp.close()
ssh.close()

print("DONE SUCCESSFULLY!")